<?php

namespace App\Http\Controllers;

use App\Http\Resources\SlotResource;
use App\Models\BookedBrunch;
use App\Models\BookedSlots;
use App\Models\BookingProduct;
use App\Models\Brunch;
use App\Models\CalendarSettings;
use App\Models\CustomSlot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $brunches = $user->brunches;
        $products = $user->products;
        $slots = $user->slots;

        $logo = null;
        $banner = null;
        if (isset($user->settings['logo'])){
            $logo = $user->settings['logo'];
        }
        if (isset($user->settings['banner'])){
            $banner = $user->settings['banner'];
        }
        $locale = Cookie::get('locale');

        return view('index', [
            'brunches' => $brunches,
            'products' => $products,
            'slots' => $slots,
            'user' => $user,
            'logo' => $logo,
            'banner' => $banner,
            'locale' => $locale
        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function slots(User $user, Request $request)
    {
        $finalSlots = [];
        $availableSlots = [];
        $queriedSlots = [];

        $from = $request->get('from');
        $to = $request->get('to');

        $slotsQuery = $user->slots()
            ->whereDate('start_date', '>=', $from)
            ->whereDate('start_date', '<=', $to)
            ->get();

        $settings = CalendarSettings::where('calendar_id', $user->id)->first();

        foreach ($slotsQuery as $slot) {
            $queriedSlots[] = ['start' => $slot->start_date, 'end' => $slot->end_date];

            if ($slot->is_available) {
                $startDate = new \DateTime($slot->start_date);

                $availableSlots[] = [
                    'start' => $slot->start_date,
                    'end' => $slot->end_date,
                    'timestamp' => $startDate->getTimestamp(),
                    'limit' => $slot->attendee_qty,
                ];
            }
        }

        $dateRange = ['from' => $from, 'to' => $to];
        $availableTime = ['from' => '08:00', 'to' => '20:00'];
        $excludingDays = ['saturday', 'sunday'];
        $intervalMinutes = 60;
        $result = $this->generateTimeSlots($dateRange, $availableTime, $excludingDays, $intervalMinutes, $queriedSlots, $user);
        $mergedSlots = array_merge($result, $availableSlots);

        usort($mergedSlots, function ($a, $b) {
            return $a['timestamp'] > $b['timestamp'];
        });

        foreach ($mergedSlots as $slot) {
            foreach ($user->languages as $language) {
                $finalSlots[] = array_merge($slot, ['language' => $language]);
            }
        }

        $transformed = [];

        foreach ($finalSlots as $slot) {
            $slot['calendar_id'] = $user->id;
            $start = new \DateTime($slot['start']);
            $end = new \DateTime($slot['end']);

            $slotQuery = BookedSlots::where('start_date', '=', $start->format('Y-m-d H:i:s'))
                ->where('end_date', '=', $end->format('Y-m-d H:i:s'))
                ->where('language', '=', $slot['language'])
                ->where('calendar_id', '=', $user->id)
                ->pluck('id')
                ->toArray();

            $slot['limit'] = $settings->default_quantity;

            if (!$slotQuery) {
                $slot['booked'] = 0;
                $transformed[] = $slot;
                continue;
            }

            $sumQuantity = BookingProduct::whereIn('slot_id', $slotQuery)->sum('quantity');

            $slot['booked'] = (int)$sumQuantity;

            $transformed[] = $slot;
        }

        return response()->json($transformed);
    }

    private function generateTimeSlots($dateRange, $availableTime, $excludingDays, $intervalMinutes, $rewritingRules, $user)
    {
        $result = [];

        $startDate = new \DateTime($dateRange['from']);
        $endDate = new \DateTime($dateRange['to']);
        $startTime = new \DateTime($availableTime['from']);
        $endTime = new \DateTime($availableTime['to']);
        $interval = new \DateInterval("PT{$intervalMinutes}M");
        $currentDate = clone $startDate;

        while ($currentDate <= $endDate) {
            $dayOfWeek = strtolower($currentDate->format('l'));

            if (!in_array($dayOfWeek, $excludingDays)) {
                $currentTime = clone $startTime;

                while ($currentTime <= $endTime) {
                    $timeSlotStart = clone $currentDate;
                    $timeSlotStart->setTime($currentTime->format('H'), $currentTime->format('i'));

                    $timeSlotEnd = clone $timeSlotStart;
                    $timeSlotEnd->add($interval);

                    // Check exclusion rules
                    $excludeSlot = false;

                    foreach ($rewritingRules as $rule) {
                        $ruleStart = new \DateTime($rule['start']);
                        $ruleEnd = new \DateTime($rule['end']);

                        // Check if the time slot is within the exclusion range
                        if ($timeSlotStart >= $ruleStart && $timeSlotEnd <= $ruleEnd) {
                            $excludeSlot = true;
                            break;
                        }
                    }

                    // Add the time slot to the result if not excluded
                    if (!$excludeSlot) {
                        $result[] = [
                            'start' => $timeSlotStart->format('Y-m-d\TH:i:s.u\Z'),
                            'end' => $timeSlotEnd->format('Y-m-d\TH:i:s.u\Z'),
                            'timestamp' => $timeSlotStart->getTimestamp(),
                        ];
                    }

                    $currentTime->add($interval);
                }
            }

            $currentDate->add(new \DateInterval('P1D'));
        }

        return $result;
    }
}
