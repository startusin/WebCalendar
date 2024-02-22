<?php

namespace App\Console\Commands;

use App\Emails\CSEmail;
use App\Models\BookedSlots;
use App\Models\BookingProduct;
use App\Models\CalendarSettings;
use App\Models\User;
use Illuminate\Console\Command;
use App\Models\Bookings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Twilio\Rest\Client;

class SendSMSBookingReminders extends Command
{
    const CRON_TIME_MINUTES = 10;

    protected $signature = 'send-sms-booking-reminders';
    protected $description = 'Send sms reminders for upcoming bookings';

    public function handle()
    {
        //$configTime = 60;
        $bookedSlots = BookedSlots::with('booking')
            ->whereHas('booking', function ($query) {
                $query->where('payment_status', 'paid');
            })->get();
        foreach ($bookedSlots as $slot) {
            $settings = CalendarSettings::where('calendar_id', $slot->calendar_id)->first();
            $configTime = $settings->sms_remind_time;

            $notificationEndTime = Carbon::now()->addMinutes($configTime - self::CRON_TIME_MINUTES);
            $notificationTime = Carbon::now()->addMinutes($configTime);
            if ($slot->start_date > $notificationEndTime && $slot->start_date < $notificationTime) {

                $this->sendNotification($slot);
            }
        }
    }

    protected function sendNotification(BookedSlots $slot)
    {
        $settings = CalendarSettings::where('calendar_id', $slot->calendar_id)->first();
        if ($settings) {
            $language = $settings->language;
            $booking = $slot->booking;

            $message = $settings->sms_reminder[$language];
            $start_date = $slot->start_date;
            $start_time = date("H:i", strtotime($start_date));
            $start_date_only = date("Y-m-d", strtotime($start_date));
            $message = str_replace('{:DATE:}', $start_date_only, $message);
            $message = str_replace('{:HOUR:}', $start_time, $message);

            $response = Http::post('https://hooks.zapier.com/hooks/catch/2825064/3etuci4/', [
                'sender' => $settings->sms_sender[$language] ?? 'SMS',
                'phone' => $booking->phone,
                'message' => $message
            ]);

            if ($response->successful()) {
                echo 'Request successful. Response: ' . $response->body();
            } else {
                echo 'Request failed. Status Code: ' . $response->status();
            }
        }
    }
}
