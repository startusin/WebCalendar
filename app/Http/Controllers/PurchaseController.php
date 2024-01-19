<?php

namespace App\Http\Controllers;

use App\Models\AvailableSlot;
use App\Models\BookingProduct;
use App\Models\Bookings;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $calendarId = $data['calendarId'];
        $slots = AvailableSlot::where('id', $data['slots'])->first();
        $products = Product::whereIn('id', array_keys($data['productIdsQuantity']))->get();

        foreach ($products as &$product) {
            foreach ($data['productIdsQuantity'] as $key => $item) {
                if ($key == $product['id']) {
                    $product['quantity'] = $item;
                }
            }
        }

        return view('purchase', compact('calendarId','products','slots'));
    }


    public function makeSlot(Request $request)
    {
        $data = $request->all();

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
            'slot_id' => $data['slotId']
        ]);

        foreach ($data['ProductQuantity'] as $id => $item) {
            BookingProduct::create([
                'product_id' => $id,
                'booking_id' =>  $booking['id'],
                'quantity' => $item['productQuantity'],
                'promocode_id' => $item['productPromo']
            ]);
        }

        return 1;//Повертати сторінку чи модальне що все успішно
    }
}
