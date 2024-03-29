<?php

namespace App\Http\Controllers;

use App\Models\BookedBrunch;
use App\Models\BookedSlots;
use App\Models\Brunch;
use App\Models\CalendarCountry;
use App\Models\BookingProduct;
use App\Models\Bookings;
use App\Models\OrderComments;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\PromoCode;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class PurchaseController extends Controller
{
    public function makeOrder()
    {
        return view('customer.orders.makeorder');
    }

    public function changeStatus(Request $request)
    {
        $data = $request->all();
        $booking = Bookings::find($data['id']);
        $booking->update(['payment_status' => $data['status']]);

        return response()->json(['message' => 'Successfully updated'], 200);
    }

    public function getAllPurchases(Request $request)
    {
        $userId = $request->calendar_user->id;

        $purchases = Bookings::with('slots')
            ->with('bookingProducts')
            ->whereHas('slots', function ($query) use ($userId) {
                $query->where('calendar_id', $userId);
            })
            ->get()
            ->map(function ($booking) use ($request) {
                $totalSoldPrice = $booking->bookingProducts->sum('sold_price');
                $totalSum = $totalSoldPrice;
                $year = substr($booking->created_at, 2, 2);
                $month = date('m', strtotime($booking->created_at));
                $id = str_pad($booking->id, 4, '0', STR_PAD_LEFT);
                $orderNumber = $year . $month . $id;
                $paymentLinkEnd = $booking->type == 'brunch' ? '?type=brunch' : '';
                $paymentLinkStart = "/payment/" . $booking->id;

                return (object)[
                    'created_at' => $booking->created_at,
                    'booking' => $booking,
                    'status' => $booking['payment_status'],
                    'total_sold_price' => $totalSum,
                    'customId' => $orderNumber,
                    'paymentLink' => $paymentLinkStart . $paymentLinkEnd
                ];
            });

        $sortBy = \request()->input('SortBy');

        if ($sortBy == 'asc') {
            $sortBy = 'desc';
            $purchases = $purchases->sortBy(\request()->input('SortName'));
        } else if ($sortBy == 'desc') {
            $sortBy = 'asc';
            $purchases = $purchases->sortByDesc(\request()->input('SortName'));
        }

        $search = \request()->input('search') ?? "";
        $purchases = collect($purchases)->filter(function ($item) use ($search) {
            return stripos($item->status, $search) !== false ||
                stripos($item->customId, $search) !== false ||
                stripos($item->total_sold_price, $search) !== false ||
                stripos($item->created_at, $search) !== false;
        });

        return view('customer.history.index', compact('purchases', 'sortBy', 'search'));
    }

    public function getPurchase($id)
    {
        return Bookings::with('slots')
            ->with('bookingProducts.product')
            ->with(['comments' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->find($id);
    }

    public function removeComment($id)
    {
        return OrderComments::find($id)->delete();
    }

    public function makeComment(Request $request)
    {
        $data = $request->all();

        return OrderComments::create([
            'order_id' => $data['order_id'],
            'comment' => $data['comment']
        ]);
    }

    public function checkprice(Request $request)
    {
        $data = $request->all();

        $startDate = new \DateTime($data['startTime']);
        $calendar_id = $data['calendarId'];
        $productPrice = [];

        if (isset($data['productIds'])) {
            foreach ($data['productIds'] as $item) {
                $product = Product::find($item);
                $productArr = $this->calculateProductPrice($product, $data['CurrentLang'], $startDate, $calendar_id);

                array_push($productPrice, $productArr);
            }
        }

        return $productPrice;
    }

    public function checkpriceForOneProduct(Request $request)
    {
        $data = $request->all();
        $startDate = new \DateTime($data['startTime']);
        $product = Product::find($data['productId']);
        $calendarId = $data['calendarId'];

        return $this->calculateProductPrice($product, $data['language'], $startDate, $calendarId, $data['quantity']);
    }


    public function index(Request $request)
    {
        $data = $request->all();
        $admin = $request->get('direct-booking') === 'true' && auth()->user();

        $slotsFront = [];
        $user = User::findOrFail((int)$request->calendarId);
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $vat = $user->settings['vat'];
        $countries = CalendarCountry::with('country')
            ->where('calendar_id', $user->id)
            ->where('is_enabled', 1)
            ->orderBy('priority')
            ->get();

        foreach ($data['slots'] as $dateTime) {
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
        $formSettings = [];

        foreach ($user->formSettings as $item) {
            $formSettings["$item->key"] = $item->is_required;
        }

        if (isset($data['type']) && $data['type'] === 'branch') {
            $brunch = Brunch::findOrFail((int)$data['branchId']);
            $isBrunch = true;
            $totalQuantity = (int)$data['branchQty'];
            $sousSum = (int)$data['branchQty'] * ($brunch->price);
            $brunchId = $data['branchId'];
            $brunchPrice = $brunch->price;
            $vat = ($sousSum * $vat / 100);
            $totalSum = $sousSum;

            $intent = $stripe->paymentIntents->create([
                'amount' => (float)$totalSum * 100,
                'currency' => 'eur',
                'automatic_payment_methods' => ['enabled' => true],
            ]);

            return view('purchase', compact('calendarId', 'vat', 'slots', 'totalQuantity', 'sousSum', 'totalSum', 'isBrunch', 'brunchId', 'brunchPrice', 'user', 'intent', 'admin', 'formSettings', 'countries'));
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

        $productData = [];
        $totalQuantity = 0;
        $sousSum = 0;
        $calendar_id = $data['calendarId'];

        foreach ($products as $item) {
            $price = $this->calculateProductPrice($item, $slots['language'], $slots['startDateSlot'], $calendar_id, $item['quantity']);

            $totalQuantity += (int)$item['quantity'];
            $sousSum += (int)$item['quantity'] * (float)$price['price'][$slots['language']];

            $productData[] = ['product' => $item, 'price' => (float)$price['price'][$slots['language']]];
        }

        $vat = ($sousSum * $vat / 100);
        $totalSum = $sousSum;
        $isBrunch = false;

        $intent = $stripe->paymentIntents->create([
            'amount' => (float)$totalSum * 100,
            'currency' => 'eur',
            'automatic_payment_methods' => ['enabled' => true],
        ]);

        return view('purchase', compact('calendarId', 'vat', 'products', 'slots', 'totalQuantity', 'sousSum', 'totalSum', 'isBrunch', 'user', 'productData', 'intent', 'admin', 'formSettings', 'countries'));
    }

    public function makeSlot(Request $request)
    {
        $data = $request->all();
        $data['calendarId'] = explode('?', $data['calendarId'])[0];
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

        $calendarId = $data['calendarId'];

        foreach ($data['ProductQuantity'] as $id => $item) {
            $product = Product::find($id);
            $language = $data['slots']->language;
            $date = new \DateTime($data['slots']->startDateSlot->date);
            $productPrice = $this->calculateProductPrice($product, $language, $date, $calendarId, $item['productQuantity']);

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

    private function calculateProductPrice(Product $product, string $lang, \DateTime $date, $calendar_id, $quantity = 0)
    {
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];

        $productArr = $product->toArray();

        $productPrices = ProductPrice::where('calendar_id', $calendar_id)
            ->where(function ($query) use ($product) {
                $query->where('product_id', $product->id)
                    ->orWhere('product_id', 0);
            })
            ->orderBy('id', 'desc')
            ->get();

        foreach ($productPrices as $range) {
            $participants = $range['price']['participants'] ?? 0;

            if ((int)$participants <= (int)$quantity) {
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
        }

        return $productArr;
    }
}
