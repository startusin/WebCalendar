<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Bookings;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FlushPendingBookings extends Command
{
    protected $signature = 'flush-pending-bookings';
    protected $description = 'Flush pending bookings';

    public function handle()
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
}
