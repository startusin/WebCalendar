<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        header("HTTP/1.1 303 See Other");
        header("Location: " . $data->url);
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

                if (isset($paymentIntent->metadata->booking_id)) {
                    $booking = Bookings::find((int)$paymentIntent->metadata->booking_id);
                    $booking->payment_status = 'paid';
                    $booking->save();
                }
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
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

    public function successPage()
    {
        die('Payment was successful!');
    }
}
