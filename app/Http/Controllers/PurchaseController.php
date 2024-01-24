<?php

namespace App\Http\Controllers;

use App\Models\BookedSlots;
use App\Models\CustomSlot;
use App\Models\BookingProduct;
use App\Models\Bookings;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function checkprice(Request $request) {

        $data = $request->all();
        $startDate = new \DateTime($data['startTime']);
        $endDate = new \DateTime($data['endTime']);

        $ProductPrice = [];

        foreach ($data['productIds'] as $item) {
            $product = Product::find($item);
            $priceDates = ProductPrice::where('product_id', $product->id)->get();
            foreach ($priceDates as $range) {
                $starRange = new \DateTime($range['start_date']);
                $endRange = new \DateTime($range['end_date']);
                if (($starRange <= $startDate && $startDate <= $endRange) || ($starRange <= $endDate && $endDate <= $endRange))
                {
                    $product['price'] = $range['price'];
                    $product['priceProduct_id'] = $range['id'];

                   break;
                }
            }
            array_push($ProductPrice, $product);
        }
        return $ProductPrice;
    }


    public function index(Request $request)
    {
        $data = $request->all();
        $slotsFront = [];
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
        $products = Product::whereIn('id', array_keys($data['productIdsQuantity']))->get();

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
        return view('purchase', compact('calendarId','products','slots'));
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
            'slot_id' => $bookedSlot['id']
        ]);
        var_dump($data);
        foreach ($data['ProductQuantity'] as $id => $item) {
            $soldPrice = 0;

            $priceDate = ProductPrice::find($item['productPriceId']);
            $priceDate = $priceDate['price']??0;
            $promoPrice = PromoCode::find($item['productPromo']);
            $promoPrice = $promoPrice['price']??0;
            var_dump($promoPrice);
            var_dump($priceDate);

            if ($promoPrice == 0 && $priceDate == 0) {
                var_dump(1);
                $product = Product::find($id);
                $soldPrice = $item['productQuantity'] * $product['price'];
            } else if (($promoPrice < $priceDate && $promoPrice != 0) || ($promoPrice > $priceDate && $priceDate == 0 ) ) {
                var_dump(2);
                $soldPrice = $item['productQuantity'] * $promoPrice;
            } else if (($priceDate < $promoPrice && $priceDate !=0) || ($priceDate > $promoPrice && $promoPrice == 0 )) {
                var_dump(3);
                $soldPrice = $item['productQuantity'] * $priceDate;
            }

            BookingProduct::create([
                'product_id' => $id,
                'booking_id' =>  $booking['id'],
                'quantity' => $item['productQuantity'],
                'promocode_id' => $item['productPromo'],
                'sold_price' => $soldPrice
            ]);
        }

        return 1;//Повертати сторінку чи модальне що все успішно
    }
}
