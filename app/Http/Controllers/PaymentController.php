<?php

namespace App\Http\Controllers;

use App\Models\BookedBrunch;
use App\Models\BookedSlots;
use App\Models\BookingProduct;
use App\Models\Bookings;
use App\Models\Brunch;
use App\Models\Indent;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\PromoCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

//use Omnipay\Omnipay;
//use App\Models\Payment;

class PaymentController extends Controller
{
    public function index(Request $request, Bookings $booking)
    {
        if ($booking->payment_status === 'paid') {
            echo 'Already paid.';

            return;
        }

        $isBrunch = $request->type === 'brunch' ?? false;

        if ($isBrunch) {
            $sum = $booking->brunches()->sum('total');
        } else {
            $sum = $booking->products()->sum('sold_price');
        }

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $product = $stripe->products->create(['name' => 'Booking ID: ' . $booking->id]);

        $price = $stripe->prices->create([
            'currency' => 'usd',
            'unit_amount_decimal' => $sum * 100,
            'product' => $product->id,
        ]);

        $data = $stripe->checkout->sessions->create([
            'customer_email' => $booking->email,
            'success_url' => url('/') . '/payment-success',
            'line_items' => [['price' => $price->id, 'quantity' => 1]],
            'mode' => 'payment',
            'payment_intent_data' => ['metadata' => ['booking_id' => $booking->id]]
        ]);

        return redirect($data->url);
    }

    public function hook(Request $request)
    {
        $endpointSecret = 'whsec_911f7bd8f396a4b56dba81150f41f06ebe2a1ff111a2eb1f41c55aea60b38920';

        $payload = @file_get_contents('php://input');
        $sign = $_SERVER['HTTP_STRIPE_SIGNATURE'];

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sign, $endpointSecret);
        } catch(\UnexpectedValueException $e) {
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            http_response_code(400);
            exit();
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $piEntity = Indent::where('indent_id', $paymentIntent->id)->first();

                if ($piEntity && empty($piEntity->booking_id)) {
                    $booking = $this->makeSlot($piEntity->data);

                    $piEntity->booking_id = $booking->id;
                    $piEntity->save();
                }

                $booking = Bookings::find($piEntity->booking_id);
                $booking->payment_status = 'paid';
                $booking->save();

                break;
            case 'payment_intent.requires_action':
                $paymentIntent = $event->data->object;
                $piEntity = Indent::where('indent_id', $paymentIntent->id)->first();

                if ($piEntity && empty($piEntity->booking_id)) {
                    $booking = $this->makeSlot($piEntity->data);

                    $piEntity->booking_id = $booking->id;
                    $piEntity->save();
                }

                break;
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response()->json(['success' => 'success', 200]);
    }

    public function cron()
    {
        $currentDateTime = Carbon::now();
        $twentyMinutesAgo = $currentDateTime->subMinutes(20);

        $results = Bookings::where('created_at', '<=', $twentyMinutesAgo)
            ->where('payment_status', '<>', 'paid')
            ->get();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($results as $result) {
            if ($result->type === 'product') {
                $result->bookingProducts()->delete();
                $result->slots()->delete();
            }

            if ($result->type === 'brunch') {
                $result->brunches()->delete();
                $result->slots()->delete();
            }

            $result->delete();
        }
    }

    public function successPage(Request $request)
    {
        $user = User::find((int)$request->calendar_id);
        return view('customer.payment.success', compact('user'));
    }

    public function updateIntent(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $updatedPaymentIntent = $stripe->paymentIntents->update(
            $request->intentId,
            ['amount' => (float)$request->totalSum * 100]
        );

        Indent::updateOrCreate(['indent_id' => $request->intentId], ['data' => $request->meta]);

        return [
            'price' => (float)$request->totalSum * 100
        ];

//        $user = User::find((int)$request->calendar_id);
//        return view('customer.payment.success', compact('user'));
    }

    private function makeSlot(array $data)
    {
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
