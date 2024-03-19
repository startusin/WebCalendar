<?php

namespace App\Console\Commands;

use App\Models\BookedSlots;
use App\Models\CalendarSettings;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class SendSMSBookingReminders extends Command
{
    protected $signature = 'send-sms-booking-reminders';
    protected $description = 'Send sms reminders for upcoming bookings';

    public function handle()
    {
        $bookedSlots = BookedSlots::with('booking')
            ->whereHas('booking', function ($query) {
                $query->where('payment_status', 'paid');
            })->get();

        foreach ($bookedSlots as $slot) {
            $settings = CalendarSettings::where('calendar_id', $slot->calendar_id)->first();
            $configTime = $settings->sms_remind_time;

            $reminderTimeStart = $slot->start_date->copy()->subMinutes($configTime);
            $reminderTimeEnd = $slot->start_date->copy();
            $currentTime = Carbon::now();

            if (!$slot->booking->sent_sms && $currentTime->isBetween($reminderTimeStart, $reminderTimeEnd)) {
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
            $dateNow = Carbon::now();

            $message = $settings->sms_reminder[$language];

            $startDate = $slot->start_date;
            $startTime = date("H:i", strtotime($startDate));
            $startDateFormatted = date("Y-m-d", strtotime($startDate));
            $message = str_replace('{:DATE:}', $startDateFormatted, $message);
            $message = str_replace('{:HOUR:}', $startTime, $message);

            $response = Http::post('https://hooks.zapier.com/hooks/catch/2825064/3etuci4/', [
                'sender' => $settings->sms_sender[$language] ?? 'SMS',
                'phone' => $booking->phone,
                'message' => $message
            ]);

            if ($response->successful()) {
                echo 'Request successful. Response: ' . $response->body();
                $booking->sent_sms = $dateNow;
                $booking->save();
            } else {
                echo 'Request failed. Status Code: ' . $response->status();
            }
        }
    }
}
