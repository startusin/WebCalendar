<?php

namespace App\Console\Commands;

use App\Emails\CSEmail;
use App\Models\BookedSlots;
use App\Models\BookingProduct;
use App\Models\CalendarSettings;
use Illuminate\Console\Command;
use App\Models\Bookings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Twilio\Rest\Client;

class SendBookingReminders extends Command
{
    const CRON_TIME_MINUTES = 10;

    protected $signature = 'send-booking-reminders';
    protected $description = 'Send reminders for upcoming bookings';

    public function handle()
    {
        //$configTime = 60;


        $bookedSlots = BookedSlots::with('booking')
            ->whereHas('booking', function ($query) {
                $query->where('payment_status', 'paid');
            })->get();

        foreach ($bookedSlots as $slot) {
            $settings = CalendarSettings::where('calendar_id', $slot->calendar_id)->first();
            $configTime = $settings->remind_time;
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
            $csEmail = $settings->cs_email[$language] ?? View::make('customer.emails.email.cs')->render();

            $csEmail = str_replace('{:LOGOTYPE:}', '<img style="margin: auto; margin-top: 20px; max-width: 250px;" src="' . ($settings->logo ? asset('storage/' . $settings->logo): '/demologo.png') . '" />', $csEmail);
            $subject = $settings->cs_email_title[$language] ?? 'Customer satisfaction title';

            Mail::to($booking->email)->send(new CSEmail($subject, $csEmail));

            print($booking->email . ' - Sent' . "\n");

            try {
                $client = new Client(getenv("TWILIO_SID"), getenv("TWILIO_TOKEN"));
                $client->messages->create($booking->phone, [
                    'from' => getenv("TWILIO_FROM"),
                    'body' => $settings->sms_reminder[$language]]
                );
            } catch (\Throwable) {}

            print($booking->phone . ' - SMS Sent' . "\n");
        }
    }
}
