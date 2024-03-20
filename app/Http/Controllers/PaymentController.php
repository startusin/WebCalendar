<?php

namespace App\Http\Controllers;

use App\Emails\AdminPurchaseEmail;
use App\Emails\PurchaseEmail;
use App\Enums\Languages;
use App\Models\BookedBrunch;
use App\Models\BookedSlots;
use App\Models\BookingProduct;
use App\Models\Bookings;
use App\Models\Brunch;
use App\Models\CalendarSettings;
use App\Models\Indent;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\PromoCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    public function index(Request $request, Bookings $booking)
    {
        if ($booking->payment_status === 'paid') {
            echo 'Already paid.';

            return;
        }

        $isBrunch = $request->type === 'brunch' ?? false;
        $vat = 0;

        if ($isBrunch) {
            $sum = $booking->brunches()->sum('total');
            $sum = $sum + ($sum * $vat / 100);
        } else {
            $sum = $booking->products()->sum('sold_price');
            $sum = $sum + ($sum * $vat / 100);
        }
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $product = $stripe->products->create(['name' => 'Booking ID: ' . $booking->id]);

        $price = $stripe->prices->create([
            'currency' => 'eur',
            'unit_amount_decimal' => $sum * 100,
            'product' => $product->id,
        ]);

        $data = $stripe->checkout->sessions->create([
            'customer_email' => $booking->email,
            'success_url' => url('/') . '/payment-success?user_id=' . $booking->slots[0]['calendar_id'] . "&date=" . $booking->slots[0]['start_date'],
            'line_items' => [['price' => $price->id, 'quantity' => 1]],
            'mode' => 'payment',
            'payment_intent_data' => ['metadata' => ['booking_id' => $booking->id]]
        ]);

        return redirect($data->url);
    }

    public function hook(Request $request)
    {
        $payload = @file_get_contents('php://input');
        $event = json_decode($payload);

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $piEntity = Indent::where('indent_id', $paymentIntent->id)->first();

                if ($piEntity && empty($piEntity->booking_id)) {
                    $booking = $this->makeSlot($piEntity->data);

                    $piEntity->booking_id = $booking->id;
                    $piEntity->save();
                }

                $bookingId = null;

                if (isset($piEntity->booking_id)) {
                    $bookingId = $piEntity->booking_id;
                }

                if (isset($paymentIntent->metadata->booking_id)) {
                    $bookingId = $paymentIntent->metadata->booking_id;
                }

                if (!$bookingId) {
                    return response()->json(['success' => false, 'message' => 'no booking id'], 422);
                }

                $booking = Bookings::find($bookingId);
                $booking->payment_status = 'paid';
                $booking->save();

                $calendarId = $booking->slots()->first()->calendar_id;
                $slotLanguage = $booking->slots()->first()->language;
                $dateStartSlot = $booking->slots()->first()->start_date;

                Carbon::setLocale($slotLanguage);

                $dateStartSlot = $dateStartSlot->isoFormat('dddd D MMMM YYYY HH[h]mm');
                $dateStartSlot = ucwords($dateStartSlot);

                $settings = CalendarSettings::where('calendar_id', $calendarId)->first();

                if ($settings) {
                    $productsHTML = '';
                    $language = $settings->language;
                    $bookingProducts = BookingProduct::where('booking_id', $booking->id)->get() ?? [];

                    $adminPurchaseEmail = $settings->admin_email[$language] ?? View::make('customer.emails.email.admin')->render();
                    $purchaseEmail = $settings->purchase_email[$language] ?? View::make('customer.emails.email.purchase')->render();
                    $itemEmail = $settings->item_email[$language] ?? View::make('customer.emails.email.item')->render();

                    $total = 0;

                    foreach ($bookingProducts as $bookingProduct) {
                        $quantity = $bookingProduct->quantity;
                        $price = number_format($bookingProduct->sold_price / $quantity, 2);


                        $itemEmailCopy = $itemEmail;
                        $itemEmailCopy = str_replace('{:TITLE:}', $bookingProduct->product->title[$language] ?? 'No Title', $itemEmailCopy);
                        $itemEmailCopy = str_replace('{:PRICE:}', $price, $itemEmailCopy);
                        $itemEmailCopy = str_replace('{:LANGUAGE:}', Languages::getTranslateLanguage($slotLanguage, $language), $itemEmailCopy);
                        $itemEmailCopy = str_replace('{:STARTSLOT:}', $dateStartSlot, $itemEmailCopy);
                        $itemEmailCopy = str_replace('{:QUANTITY:}', $quantity, $itemEmailCopy);
                        $itemEmailCopy = str_replace('{:TOTAL_TTC:}', $bookingProduct->sold_price, $itemEmailCopy);
                        $total += (double)$bookingProduct->sold_price;

                        $productsHTML .= $itemEmailCopy;
                    }

                    $total = number_format($total, 2);

                    $purchaseEmail = str_replace('{:TOTAL_PRICE:}', $total, $purchaseEmail);
                    $purchaseEmail = str_replace('{:ITEMS:}', $productsHTML, $purchaseEmail);
                    $purchaseEmail = str_replace('{:LANGUAGE:}', Languages::getTranslateLanguage($slotLanguage, $language), $purchaseEmail);
                    $purchaseEmail = str_replace('{:STARTSLOT:}', $dateStartSlot, $purchaseEmail);
                    $purchaseEmail = str_replace('{:LOGOTYPE:}', '<img style="margin: auto; margin-top: 20px; max-width: 250px;" src="' . ($settings->logo ? asset('storage/' . $settings->logo) : '/demologo.png') . '" />', $purchaseEmail);

                    $adminPurchaseEmail = str_replace('{:TOTAL_PRICE:}', $total, $adminPurchaseEmail);
                    $adminPurchaseEmail = str_replace('{:LANGUAGE:}', Languages::getTranslateLanguage($slotLanguage, $language), $adminPurchaseEmail);
                    $adminPurchaseEmail = str_replace('{:STARTSLOT:}', $dateStartSlot, $adminPurchaseEmail);
                    $adminPurchaseEmail = str_replace('{:ITEMS:}', $productsHTML, $adminPurchaseEmail);
                    $adminPurchaseEmail = str_replace('{:LOGOTYPE:}', '<img style="margin: auto; margin-top: 20px; max-width: 250px;" src="' . ($settings->logo ? asset('storage/' . $settings->logo) : '/demologo.png') . '" />', $adminPurchaseEmail);

                    $subject = $settings->admin_email_title[$language] ?? 'Purchase title';

                    Mail::to($booking->email)->send(new PurchaseEmail($subject, $purchaseEmail, $settings->main_email, $settings->main_name));
                    Mail::to($settings->main_email)->send(new AdminPurchaseEmail($subject, $adminPurchaseEmail, $settings->main_email, $settings->main_name));
                }

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
        $user = User::find((int)$request->input('user_id'));
        $logo = null;

        $date = $request->input('date');
        if (isset($user->settings['logo'])) {
            $logo = $user->settings['logo'];
        }

        return view('customer.payment.success', compact('user', 'logo', 'date'));
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

        $calendar_id = $data['calendarId'];
        foreach ($data['ProductQuantity'] as $id => $item) {
            $product = Product::find($id);
            $language = $data['slots']->language;
            $date = new \DateTime($data['slots']->startDateSlot->date);
            $productPrice = $this->calculateProductPrice($product, $language, $date, $calendar_id, $item['productQuantity']);

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
            if ((int)$range['price']['participants'] <= (int)$quantity) {

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
