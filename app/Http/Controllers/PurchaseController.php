<?php

namespace App\Http\Controllers;

use App\Models\BookedBrunch;
use App\Models\BookedSlots;
use App\Models\Brunch;
use App\Models\CustomSlot;
use App\Models\BookingProduct;
use App\Models\Bookings;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\PromoCode;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PurchaseController extends Controller
{
    public function getAllPurchases()
    {
        $userId = auth()->user()->id;

        $purchases = Bookings::with('slots')
            ->with('bookingProducts')
            ->whereHas('slots', function ($query) use ($userId) {
                $query->where('calendar_id', $userId);
            })->get()
            ->map(function ($booking) {
                $totalSoldPrice = $booking->bookingProducts->sum('sold_price');

                $year = substr($booking->created_at, 2, 2);
                $month = date('m', strtotime($booking->created_at));
                $id = str_pad($booking->id, 4, '0', STR_PAD_LEFT);
                $orderNumber = $year . $month . $id;
                return (object)[
                    'booking' => $booking,
                    'total_sold_price' => $totalSoldPrice,
                    'customId' => $orderNumber
                ];
            });

        return view('customer.history.index', compact('purchases'));
    }

    public function getPurchase($id)
    {
        return Bookings::with('slots')
            ->with('bookingProducts.product')
            ->find($id);
    }


    public function checkprice(Request $request)
    {
        $data = $request->all();
        $startDate = new \DateTime($data['startTime']);
        $endDate = new \DateTime($data['endTime']);

        $ProductPrice = [];

        if (isset($data['productIds'])) {
            foreach ($data['productIds'] as $item) {
                $product = Product::find($item);

                $productArr = $this->calculateProductPrice($product, $data['CurrentLang'], $startDate);

                array_push($ProductPrice, $productArr);
            }
        }

        return $ProductPrice;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $slotsFront = [];
        $user = User::findOrFail((int)$request->calendarId);

        foreach ($data['slots'] as $key => $dateTime) {
            foreach ($dateTime as $items) {
                foreach ($items as $item) {
                    $slotObject = [
                        'startDateSlot' => new \DateTime($item['startTime']),
                        'endDateSlot' => new \DateTime($item['endTime']),
                        'timestamp' => $item['timestamp'],
                        'language' => $item['language']
                    ];

                    $slotsFront[] = $slotObject;
                }
            }
        }

        $calendarId = $data['calendarId'];
        $slots = $slotsFront[0];

        if (isset($data['type']) && $data['type'] === 'branch') {
            $brunch = Brunch::findOrFail((int)$data['branchId']);

            $isBrunch = true;
            $totalQuantity = (int)$data['branchQty'];
            $totalSum = (int)$data['branchQty'] * ($brunch->price);
            $brunchId = $data['branchId'];
            $brunchPrice = $brunch->price;

            return view('purchase', compact('calendarId', 'slots', 'totalQuantity', 'totalSum', 'isBrunch', 'brunchId', 'brunchPrice', 'user'));
        }

        $products = Product::whereIn('id', array_keys($data['productIdsQuantity']))->get();

        foreach ($products as &$product) {
            foreach ($data['productIdsQuantity'] as $key => $item) {
                if ($key == $product['id']) {
                    $product['quantity'] = $item;
                }
            }
            if (isset($data['productPriceId'])) {
                foreach ($data['productPriceId'] as $item) {
                    $price_product = ProductPrice::find($item);
                    if ($price_product['product_id'] == $product['id']) {
                        $product['price'] = $price_product['price'];
                        $product['product_price_id'] = $price_product['id'];
                    }
                }
            }
        }

        $totalQuantity = 0;
        $totalSum = 0;

        $productData = [];

        foreach ($products as $item) {
            $price = $this->calculateProductPrice($item, $slots['language'], $slots['startDateSlot']);

            $totalQuantity += (int)$item['quantity'];
            $totalSum += (int)$item['quantity'] * (float)$price['price'][$slots['language']];

            $productData[] = ['product' => $item, 'price' => (float)$price['price'][$slots['language']]];
        }

        $isBrunch = false;

        return view('purchase', compact('calendarId', 'products', 'slots', 'totalQuantity', 'totalSum', 'isBrunch', 'user', 'productData'));
    }

    public function makeSlot(Request $request)
    {
        $data = $request->all();
        $data['slots'] = json_decode($data['slots']);

        $bookedSlot = BookedSlots::create([
            'start_date' => $data['slots']->startDateSlot->date,
            'end_date' => $data['slots']->endDateSlot->date,
            'timestamp' => $data['slots']->timestamp,
            'language' => $data['slots']->language,
            'calendar_id' => $data['calendarId'],
        ]);

        $booking = Bookings::create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'email' => $data['emailName'],
            'company_name' => $data['companyName'],
            'region' => $data['RegionName'],
            'street_name' => $data['streetName'],
            'place' => $data['placeName'],
            'postal_code' => $data['postalCodeName'],
            'phone' => $data['phoneName'],
            'slot_id' => $bookedSlot['id'],
            'type' => isset($data['type']) && $data['type'] === 'brunch' ? 'brunch' : 'product'
        ]);

        $bookedSlot->booking_id = $booking->id;
        $bookedSlot->save();

        if (isset($data['type']) && $data['type'] === 'brunch') {
            $brunch = Brunch::findOrFail((int)$data['brunchId']);
            $time = $brunch->time;
            $date = explode(' ', $data['slots']->startDateSlot->date);

            BookedBrunch::create([
                'brunch_date' => $date[0] . ' ' . $time,
                'quantity' => $data['qty'],
                'calendar_id' => $data['calendarId'],
                'booking_id' => $booking->id,
                'brunch_id' => $brunch->id,
                'total' => $brunch->price * (int)$data['qty'],
            ]);

            return $booking;
        }

        foreach ($data['ProductQuantity'] as $id => $item) {
            $product = Product::find($id);
            $language = $data['slots']->language;
            $date = new \DateTime($data['slots']->startDateSlot->date);
            $productPrice = $this->calculateProductPrice($product, $language, $date);

            $promoPrice = PromoCode::find((int)$item['productPromo']);
            $soldPrice = $promoPrice['price'] ?? (int)$item['productQuantity'] * (float)$productPrice['price'][$language];

            BookingProduct::create([
                'product_id' => $id,
                'booking_id' => $booking['id'],
                'slot_id' => $bookedSlot['id'],
                'quantity' => $item['productQuantity'],
                'promocode_id' => $item['productPromo'],
                'sold_price' => $soldPrice
            ]);
        }

        return $booking;
    }

    public function loadBrunches(Request $request)
    {
        $data = $request->all();
        $start = new \DateTime($data['startTime']);
        $calendarId = $data['calendarId'];
        $dayOfWeek = strtolower($start->format('l'));

        $brunches = Brunch::where('calendar_id', (int)$calendarId)->orderBy('time', 'ASC')->get();
        $brunchCollected = [];

        if ($brunches) {
            foreach ($brunches as $brunch) {
                $datetime = $start->format('Y-m-d') . ' ' . $brunch->time;
                $booked = BookedBrunch::where('calendar_id', $calendarId)
                    ->where('brunch_date', $datetime)
                    ->sum('quantity');

                if (!empty($brunch->excluded_days) && in_array($dayOfWeek, $brunch->excluded_days)) {
                    continue;
                }

                $brunchCollected[] = [
                    'id' => $brunch->id,
                    'time' => $brunch->time,
                    'quantity' => $brunch->quantity,
                    'price' => $brunch->price,
                    'booked' => (int)$booked,
                ];
            }
        }

        return $brunchCollected;
    }

    private function calculateProductPrice(Product $product, string $lang, \DateTime $date)
    {
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];

        $productArr = $product->toArray();
        $productPrices = ProductPrice::where('product_id', $product->id)->get();

        foreach ($productPrices as $range) {
            if ($lang === $range->price['language']) {
                $hour = $date->format('H:i');
                $startTime = \DateTime::createFromFormat('H:i', $range->price['fromHour']);
                $endTime = \DateTime::createFromFormat('H:i', $range->price['toHour']);
                $nowTime = \DateTime::createFromFormat('H:i', $hour);

                if ($range->price['dynamicSelect'] === 'days' || in_array(strtolower($range->price['dynamicSelect']), $daysOfWeek)) {
                    $dayOfWeek = strtolower($date->format('l'));
                    $fromIndex = (int)$range->price['start'];
                    $toIndex = (int)$range->price['end'];
                    $currentDayIndex = array_search($dayOfWeek, $daysOfWeek) + 1;

                    if (($currentDayIndex >= $fromIndex && $currentDayIndex <= $toIndex) && ($nowTime >= $startTime && $nowTime <= $endTime)) {
                        if ($range->price['type'] === 'fixed') {
                            $productArr['price'][$lang] = $range->price['value'];
                        }

                        if ($range->price['type'] === 'add') {
                            $productArr['price'][$lang] += $range->price['value'];
                        }

                        if ($range->price['type'] === 'subtract') {
                            $productArr['price'][$lang] -= $range->price['value'];
                        }

                        if ($range->price['type'] === 'multiply') {
                            $productArr['price'][$lang] *= $range->price['value'];
                        }

                        if ($range->price['type'] === 'divide') {
                            $price = $productArr['price'][$lang] / $range->price['value'];
                            $productArr['price'][$lang] = number_format($price, 2);
                        }
                    }
                }

                if ($range->price['dynamicSelect'] === 'allWeeks') {
                    if ($range->price['type'] === 'fixed') {
                        $productArr['price'][$lang] = $range->price['value'];
                    }

                    if ($range->price['type'] === 'add') {
                        $productArr['price'][$lang] += $range->price['value'];
                    }

                    if ($range->price['type'] === 'subtract') {
                        $productArr['price'][$lang] -= $range->price['value'];
                    }

                    if ($range->price['type'] === 'multiply') {
                        $productArr['price'][$lang] *= $range->price['value'];
                    }

                    if ($range->price['type'] === 'divide') {
                        $price = $productArr['price'][$lang] / $range->price['value'];
                        $productArr['price'][$lang] = number_format($price, 2);
                    }
                }

                if ($range->price['dynamicSelect'] === 'months') {
                    $month = strtolower($date->format('F'));

                    $monthsRangeStartIndex = array_search(strtolower($range->price['start']), $months);
                    $monthsRangeEndIndex = array_search(strtolower($range->price['end']), $months);

                    $monthsRangeStartIndex = (int)$range->price['start'];
                    $monthsRangeEndIndex = (int)$range->price['end'];
                    $currentMonthIndex = array_search($month, $months) + 1;

                    if (($currentMonthIndex !== false && $currentMonthIndex >= $monthsRangeStartIndex && $currentMonthIndex <= $monthsRangeEndIndex) && ($nowTime >= $startTime && $nowTime <= $endTime)) {
                        if ($range->price['type'] === 'fixed') {
                            $productArr['price'][$lang] = $range->price['value'];
                        }

                        if ($range->price['type'] === 'add') {
                            $productArr['price'][$lang] += $range->price['value'];
                        }

                        if ($range->price['type'] === 'subtract') {
                            $productArr['price'][$lang] -= $range->price['value'];
                        }

                        if ($range->price['type'] === 'multiply') {
                            $productArr['price'][$lang] *= $range->price['value'];
                        }

                        if ($range->price['type'] === 'divide') {
                            $price = $productArr['price'][$lang] / $range->price['value'];
                            $productArr['price'][$lang] = number_format($price, 2);
                        }
                    }
                }

                if ($range->price['dynamicSelect'] === 'customs') {
                    $month = intval($date->format('m'));
                    $day = intval($date->format('d'));

                    list($rangeStartMonth, $rangeStartDay) = explode('-', $range->price['start']);
                    list($rangeEndMonth, $rangeEndDay) = explode('-', $range->price['end']);

                    $rangeStartMonth = intval($rangeStartMonth);
                    $rangeStartDay = intval($rangeStartDay);
                    $rangeEndMonth = intval($rangeEndMonth);
                    $rangeEndDay = intval($rangeEndDay);

                    if (
                        ($month > $rangeStartMonth || ($month == $rangeStartMonth && $day >= $rangeStartDay)) &&
                        ($month < $rangeEndMonth || ($month == $rangeEndMonth && $day <= $rangeEndDay)) &&
                        ($nowTime >= $startTime && $nowTime <= $endTime)
                    ) {
                        if ($range->price['type'] === 'fixed') {
                            $productArr['price'][$lang] = $range->price['value'];
                        }

                        if ($range->price['type'] === 'add') {
                            $productArr['price'][$lang] += $range->price['value'];
                        }

                        if ($range->price['type'] === 'subtract') {
                            $productArr['price'][$lang] -= $range->price['value'];
                        }

                        if ($range->price['type'] === 'multiply') {
                            $productArr['price'][$lang] *= $range->price['value'];
                        }

                        if ($range->price['type'] === 'divide') {
                            $price = $productArr['price'][$lang] / $range->price['value'];
                            $productArr['price'][$lang] = number_format($price, 2);
                        }
                    }
                }
            }
        }

        return $productArr;
    }
}
