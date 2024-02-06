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
        $purchases = BookingProduct::paginate(10);
        return view('customer.history.index', compact('purchases'));
    }

    public function getPurchase($id)
    {
        $purhase = BookingProduct::with('product', 'booking','slot')->findorfail($id);
        foreach ($purhase->product['title'] as $key => $item)
        {
            if ($key == Cookie::get('locale')) {
                $purhase->product['title'] = $item;
                break;
            }
        }
        return $purhase;
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

                $priceDates = ProductPrice::where('product_id', $product->id)->get();

                foreach ($priceDates as $range) {
                    $starRange = new \DateTime($range['start_date']);
                    $endRange = new \DateTime($range['end_date']);
                    if (($starRange <= $startDate && $startDate <= $endRange) || ($starRange <= $endDate && $endDate <= $endRange))
                    {

                        if ($data['CurrentLang'] == $range['language']) {

                            //Error

                            //dd($product->price[$data['CurrentLang']]=2);

                            $product['price'][$data['CurrentLang']] = $range['price'];
                            $product['priceProduct_id'] = $range['id'];

                            break;
                        }
                    }
                }
                array_push($ProductPrice, $product);
            }
        }

        return $ProductPrice;
    }


    public function index(Request $request)
    {
        $data = $request->all();
        $slotsFront = [];
        $user = User::findOrFail((int)$request->calendarId);

        foreach ($data['slots'] as $key => $dateTime)
        {
            foreach ($dateTime as $items) {
                foreach ($items as $item) {
                    $slotObject = [
                        'startDateSlot' => new \DateTime($item['startTime']),
                        'endDateSlot' => new \DateTime($item['endTime']),
                        'timestamp' =>  $item['timestamp'],
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
        dd($data);
        foreach ($products as &$product) {
            foreach ($data['productIdsQuantity'] as $key => $item) {
                if ($key == $product['id']) {
                    $product['quantity'] = $item;
                }
            }
            if (isset($data['productPriceId'])){
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

        foreach ($products as $item) {
            $totalQuantity+= $item['quantity'];
            $totalSum+= $item['quantity']*$item['price'];
        }

        $isBrunch = false;

        return view('purchase', compact('calendarId','products','slots', 'totalQuantity', 'totalSum', 'isBrunch', 'user'));
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
            $soldPrice = 0;

            $priceDate = ProductPrice::find($item['productPriceId']);
            $priceDate = $priceDate['price']??0;
            $promoPrice = PromoCode::find($item['productPromo']);
            $promoPrice = $promoPrice['price']??0;

            if ($promoPrice == 0 && $priceDate == 0) {
                $product = Product::find($id);
                $soldPrice = $item['productQuantity'] * $product['price'];
            } else if (($promoPrice < $priceDate && $promoPrice != 0) || ($promoPrice > $priceDate && $priceDate == 0 ) ) {
                $soldPrice = $item['productQuantity'] * $promoPrice;
            } else if (($priceDate < $promoPrice && $priceDate !=0) || ($priceDate > $promoPrice && $promoPrice == 0 )) {
                $soldPrice = $item['productQuantity'] * $priceDate;
            }

            BookingProduct::create([
                'product_id' => $id,
                'booking_id' =>  $booking['id'],
                'slot_id' =>  $bookedSlot['id'],
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
}
