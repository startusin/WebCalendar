<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Bookings;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class FlushPendingBookings extends Command
{
    protected $signature = 'flush-pending-bookings';
    protected $description = 'Flush pending bookings';

    public function handle()
    {
        $currentDateTime = Carbon::now();
        $twentyMinutesAgoTime = $currentDateTime->subMinutes(20);

        $results = Bookings::with('slots')->where('created_at', '<=', $twentyMinutesAgoTime)
            ->where('payment_status', '<>', 'paid')
            ->get();

        $calendarIds = Bookings::with('slots')
            ->where('created_at', '<=', $twentyMinutesAgoTime)
            ->where('payment_status', '<>', 'paid')
            ->get()
            ->flatMap(function ($booking) {
                return $booking->slots->pluck('calendar_id');
            });

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
        foreach ($calendarIds as $id) {
            Redis::del('slots-' . $id);
        }
    }
}
