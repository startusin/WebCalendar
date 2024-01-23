<?php

namespace App\Http\Controllers;

use App\Models\BookedSlots;
use App\Models\CustomSlot;
use App\Models\BookingProduct;
use App\Models\Bookings;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
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

        //$slots = CustomSlot::where('id', $data['slots'])->first();
        $slots = $slotsFront[0];
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
