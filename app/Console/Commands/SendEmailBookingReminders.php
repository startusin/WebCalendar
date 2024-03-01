<?php

namespace App\Console\Commands;

use App\Emails\CSEmail;
use App\Enums\Languages;
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

class SendEmailBookingReminders extends Command
{
    protected $signature = 'send-email-booking-reminders';
    protected $description = 'Send email reminders for upcoming bookings';

    public function handle()
    {
        $bookedSlots = BookedSlots::with('booking')
            ->whereHas('booking', function ($query) {
                $query->where('payment_status', 'paid');
            })->get();

        foreach ($bookedSlots as $slot) {
            $settings = CalendarSettings::where('calendar_id', $slot->calendar_id)->first();
            $configTime = $settings->remind_time;

            $reminderTimeStart = $slot->start_date->copy()->subMinutes($configTime);
            $reminderTimeEnd = $slot->start_date->copy();
            $currentTime = Carbon::now();

            if (!$slot->booking->sent_email && $currentTime->isBetween($reminderTimeStart, $reminderTimeEnd)) {
                $this->sendNotification($slot);
            }
        }
    }

    protected function sendNotification(BookedSlots $slot)
    {
        $settings = CalendarSettings::where('calendar_id', $slot->calendar_id)->first();
        if ($settings) {
            $language = $settings->language;
            $DateNow = Carbon::now();
            $booking = $slot->booking;

            $csEmail = $settings->cs_email[$language] ?? View::make('customer.emails.email.cs')->render();
            $csEmail = str_replace('{:LOGOTYPE:}', '<img style="margin: auto; margin-top: 20px; max-width: 250px;" src="' . ($settings->logo ? asset('storage/' . $settings->logo): '/demologo.png') . '" />', $csEmail);
            $csEmail = str_replace('{:LANGUAGE:}', Languages::getStringLanguage($slot->language), $csEmail);
            $subject = $settings->cs_email_title[$language] ?? 'Customer satisfaction title';
            Mail::to($booking->email)->send(new CSEmail($subject, $csEmail, $settings->main_email, $settings->main_name));
            $booking->sent_email = $DateNow;
            $booking->save();
            print($booking->email . ' - Sent' . "\n");
        }
    }
}
