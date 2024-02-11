<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Carbon\Carbon;

class TaskController extends Controller
{
    const CRON_TIME_MINUTES = 20;

    public function sendNotification() {
        $currentDateTime = Carbon::now();
        $OneHourNext = $currentDateTime->copy()->addHour(1);

        $bookings = Bookings::
            where('created_at', '>=', $currentDateTime)
            ->where('start_date', '<', $OneHourNext)
            ->whereHas('booking', function ($query) {
                $query->where('payment_status', 'paid');
            })
            ->get()
            ->pluck('booking.email');


        return $bookedSlots;
    }
}
