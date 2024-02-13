<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Http\Resources\SlotResource;
use App\Models\BookedBrunch;
use App\Models\BookedSlots;
use App\Models\BookingProduct;
use App\Models\Brunch;
use App\Models\CalendarSettings;
use App\Models\CustomSlot;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function languages()
    {
        return Languages::getMyLanguages(auth()->user()->languages);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        if (!$user->settings || !$user->translations) {
            die('Calendar isn\'t configured. Login and go to Settings tab and configure it, and you must to save translations');
        }

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
        if (!$locale) {
            $locale = $user->settings['language'] ?? 'en';
        }
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
        $currentYear = date('Y');

        $from = $request->get('from');
        $to = $request->get('to');

        $settings = CalendarSettings::where('calendar_id', $user->id)->first();

        $excludingDays = $settings->excluded_days ?? [];

        $result = [];

        $rules = CustomSlot::where('calendar_id', $user->id)->get();

        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($rules as $rule)
        {
            switch ($rule['period_type']['dynamicSelect']){
                case 'customs':
                    $startDateTime = implode('-', [$currentYear, $rule['period_type']['start']]);
                    $endDateTime = implode('-', [$currentYear, $rule['period_type']['end']]);
                    $arr = generateCustomsSlots($from, $to, $startDateTime, $endDateTime, $rule['period_type']['fromHour'], $rule['period_type']['toHour'], $excludingDays,$rule['period_type']['language'],$rule['period_type']['quantity'], $rule['period_type']['is_available']);
                    $result = array_merge($result,$arr);
                    $queriedSlots = array_merge($queriedSlots,$arr);
                    break;
                case 'days' || in_array( strtolower($rule['period_type']['dynamicSelect']), $daysOfWeek):
                    $arr = generateWeeksSlots($from, $to, $rule['period_type']['start'], $rule['period_type']['end'], $rule['period_type']['fromHour'], $rule['period_type']['toHour'], $excludingDays,$rule['period_type']['language'],$rule['period_type']['quantity'], $rule['period_type']['is_available'] );
                    $result = array_merge($result,$arr);
                    $queriedSlots = array_merge($queriedSlots,$arr);
                    break;
                case 'allWeeks':
                    $arr = generateWeeksSlots($from, $to, 1, 7, $rule['period_type']['fromHour'], $rule['period_type']['toHour'], $excludingDays,$rule['period_type']['language'],$rule['period_type']['quantity'], $rule['period_type']['is_available'] );
                    $result = array_merge($result,$arr);
                    $queriedSlots = array_merge($queriedSlots,$arr);
                    break;
                case 'months':
                    $arr = generateMonthSlots($from, $to, $rule['period_type']['start'], $rule['period_type']['end'], $rule['period_type']['fromHour'], $rule['period_type']['toHour'], $excludingDays,$rule['period_type']['language'],$rule['period_type']['quantity'], $rule['period_type']['is_available']);
                    $result = array_merge($result,$arr);
                    $queriedSlots = array_merge($queriedSlots,$arr);
                    break;
                }

        }
        $dateRange = ['from' => $from, 'to' => $to];

        foreach ($user->settings->interval as $lang => $interval) {
            $availableTime = ['from' => $settings['working_hr_start'][$lang], 'to' => $settings['working_hr_end'][$lang]];
            $resFunc = $this->generateTimeSlots($dateRange, $availableTime, $excludingDays, $interval, $queriedSlots, $user,$lang);
            $result = array_merge($result,$resFunc);
        }

        $mergedSlots = array_merge($result, $availableSlots);
        usort($mergedSlots, function ($a, $b) {
            return $a['timestamp'] > $b['timestamp'];
        });

        foreach ($mergedSlots as $slot) {
            $finalSlots[] = $slot;
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
            if (!isset($slot['limit'])) {
                foreach ($user->languages as $lang) {
                    if ($lang == $slot['language']) {
                        $slot['limit'] = $user->settings['default_quantity'][$lang];
                    }
                }
            }
            if (!$slotQuery && $slot['is_available'] == 1) {
                $slot['booked'] = 0;
                $transformed[] = $slot;
                continue;
            }

            $sumQuantity = BookingProduct::whereIn('slot_id', $slotQuery)->sum('quantity');

            $slot['booked'] = (int)$sumQuantity;
            if ($slot['is_available'] == 1) {
            $transformed[] = $slot;
            }
        }
        return response()->json($transformed);
    }

    private function generateTimeSlots($dateRange, $availableTime, $excludingDays, $intervalMinutes, $rewritingRules, $user, $lang)
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

                    $excludeSlot = false;

                    foreach ($rewritingRules as $rule) {
                        if ($rule['language']==$lang) {
                        $ruleStart = new \DateTime($rule['start']);
                        $ruleEnd = new \DateTime($rule['end']);


                        if ($timeSlotStart >= $ruleStart && $timeSlotStart <= $ruleEnd) {
                            $excludeSlot = true;
                            break;
                        }
                        }
                    }

                    if (!$excludeSlot) {
                        $result[] = [
                            'start' => $timeSlotStart->format('Y-m-d\TH:i:s.u\Z'),
                            'end' => $timeSlotEnd->format('Y-m-d\TH:i:s.u\Z'),
                            'timestamp' => $timeSlotStart->getTimestamp(),
                            'language' => $lang,
                            'is_available' => 1
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

    function generateWeeksSlots($from, $to, $startRangeWeek, $endRangeWeek, $fromHour, $toHour, $excludedDays, $language, $limit, $isAvailable) {
        $objects = array();
        $excludedDays = transformDays($excludedDays);

        $startDate = new DateTime($from);
        $endDate = new DateTime($to);

        while ($startDate <= $endDate) {
            $currentWeekDay = $startDate->format('N'); // 1 для понеділка, 7 для неділі
            if ($currentWeekDay >= $startRangeWeek && $currentWeekDay <= $endRangeWeek && !in_array($currentWeekDay, $excludedDays)) {
                $startDateTime = new DateTime($startDate->format('Y-m-d') . ' ' . $fromHour);
                $endDateTime = new DateTime($startDate->format('Y-m-d') . ' ' . $toHour);
                $object = array(
                    'start' => $startDateTime->format('Y-m-d\TH:i:s.u\Z'),
                    'end' => $endDateTime->format('Y-m-d\TH:i:s.u\Z'),
                    'timestamp' => $startDateTime->getTimestamp(),
                    'language' => $language,
                    'limit' => $limit,
                    'is_available' => $isAvailable
                );
                $objects[] = $object;
            }
            $startDate->modify('+1 day');
        }
        return $objects;
    }

    function generateMonthSlots($from, $to, $startRangeMonth, $endRangeMonth, $fromHour, $toHour, $excludedDays, $language, $limit, $isAvailable) {
        $objects = array();
        $excludedDays = transformDays($excludedDays);

        $startDate = new DateTime($from);
        $endDate = new DateTime($to);

        while ($startDate <= $endDate) {
            $currentMonth = (int)$startDate->format('m');
            if ($currentMonth >= $startRangeMonth && $currentMonth <= $endRangeMonth) {
                $currentDayOfWeek = (int)$startDate->format('N'); // 1 - Понеділок, 7 - Неділя
                if (!in_array($currentDayOfWeek, $excludedDays)) {
                    // Створення об'єкту з датою початку та кінця на основі заданих годин
                    $startDateTime = new DateTime($startDate->format('Y-m-d') . ' ' . $fromHour);
                    $endDateTime = new DateTime($startDate->format('Y-m-d') . ' ' . $toHour);
                    $object = array(
                        'start' => $startDateTime->format('Y-m-d\TH:i:s.u\Z'),
                        'end' => $endDateTime->format('Y-m-d\TH:i:s.u\Z'),
                        'timestamp' => $startDateTime->getTimestamp(),
                        'language' => $language,
                        'limit' => $limit,
                        'is_available' => $isAvailable
                    );
                    $objects[] = $object;
                }
            }
            $startDate->modify('+1 day');
        }

        return $objects;
    }


    function generateCustomsSlots($from, $to, $startCustomDate, $endCustomDate, $fromHour, $toHour, $excludedDays, $language, $limit, $isAvailable) {
        $objects = array();
        $excludedDays = transformDays($excludedDays);
        $startDate = new DateTime($from);
        $endDate = new DateTime($to);

        $startCustomDateTime = new DateTime($startCustomDate);
        $endCustomDateTime = new DateTime($endCustomDate);

        while ($startDate <= $endDate) {
            if ($startDate >= $startCustomDateTime && $startDate <= $endCustomDateTime) {
                $currentWeekDay = $startDate->format('N'); // 1 для понеділка, 7 для неділі
                if (!in_array($currentWeekDay, $excludedDays)) {
                    $startDateTime = new DateTime($startDate->format('Y-m-d') . ' ' . $fromHour);
                    $endDateTime = new DateTime($startDate->format('Y-m-d') . ' ' . $toHour);
                    $object = array(
                        'start' => $startDateTime->format('Y-m-d\TH:i:s.u\Z'),
                        'end' => $endDateTime->format('Y-m-d\TH:i:s.u\Z'),
                        'timestamp' => $startDateTime->getTimestamp(),
                        'language' => $language,
                        'limit' => $limit,
                        'is_available' => $isAvailable
                    );
                    $objects[] = $object;
                }
            }
            $startDate->modify('+1 day');
        }

        return $objects;
    }

function transformDays($array) {
    $daysMap = array(
        'monday' => 1,
        'tuesday' => 2,
        'wednesday' => 3,
        'thursday' => 4,
        'friday' => 5,
        'saturday' => 6,
        'sunday' => 7
    );

    $transformedDays = array();

    foreach ($array as $day) {
        if (array_key_exists(strtolower($day), $daysMap)) {
            $transformedDays[] = $daysMap[strtolower($day)];
        }
    }
    return $transformedDays;
}
