<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Models\BookedSlots;
use App\Models\BookingProduct;
use App\Models\CalendarSettings;
use App\Models\CustomSlot;
use App\Models\User;
use App\Services\SlotService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    private SlotService $slotService;

    public function __construct(SlotService $slotService)
    {
        $this->slotService = $slotService;
    }

    public function languages(Request $request)
    {
        return Languages::getUserLanguages($request->calendar_user->languages);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $alias)
    {
        $admin = $request->get('direct-booking') === 'true';
        $user = User::where('alias', $alias)->first();
        if (!$user) {
            abort(404);
        }

        if (!$user->settings || !$user->translations) {
            die('Calendar isn\'t configured. Login and go to Settings tab and configure it, and you must to save translations');
        }

        $brunches = $user->brunches;
        $products = $user->products()->orderBy('priority')->get();
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
            'locale' => $locale,
            'admin' => $admin
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function slots($id, Request $request)
    {
        $user = User::find($id);
        $from = $request->get('from');
        $to = $request->get('to');
        $hash = md5($from . ':' . $to);

        $cachedSlots = Redis::get('slots-' . $user->id . '-' . $hash);

        if ($cachedSlots && !empty($cachedSlots)) {
            return response()->json(json_decode($cachedSlots));
        }

        $availableSlots = [];
        $queriedSlots = [];
        $currentYear = date('Y');

        $settings = CalendarSettings::where('calendar_id', $user->id)->first();
        $excludingDays = $settings->excluded_days ?? [];
        $rules = CustomSlot::where('calendar_id', $user->id)->orderBy('id', 'desc')->get();
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($rules as $rule)
        {
            switch ($rule['period_type']['dynamicSelect']){
                case 'customs':
                    $startDateTime = implode('-', [$currentYear, $rule['period_type']['start']]);
                    $endDateTime = implode('-', [$currentYear, $rule['period_type']['end']]);
                    $arr = $this->slotService->generateCustomSlots($from, $to, $startDateTime, $endDateTime, $rule['period_type']['fromHour'], $rule['period_type']['toHour'], $excludingDays,$rule['period_type']['language'],$rule['period_type']['quantity'], $rule['period_type']['is_available']);
                    $queriedSlots = array_merge($queriedSlots,$arr);
                    break;
                case 'days' || in_array( strtolower($rule['period_type']['dynamicSelect']), $daysOfWeek):
                    $arr = $this->slotService->generateWeeksSlots($from, $to, $rule['period_type']['start'], $rule['period_type']['end'], $rule['period_type']['fromHour'], $rule['period_type']['toHour'], $excludingDays,$rule['period_type']['language'],$rule['period_type']['quantity'], $rule['period_type']['is_available'] );
                    $queriedSlots = array_merge($queriedSlots,$arr);
                    break;
                case 'allWeeks':
                    $arr = $this->slotService->generateWeeksSlots($from, $to, 1, 7, $rule['period_type']['fromHour'], $rule['period_type']['toHour'], $excludingDays,$rule['period_type']['language'],$rule['period_type']['quantity'], $rule['period_type']['is_available'] );
                    $queriedSlots = array_merge($queriedSlots,$arr);
                    break;
                case 'months':
                    $arr = $this->slotService->generateMonthSlots($from, $to, $rule['period_type']['start'], $rule['period_type']['end'], $rule['period_type']['fromHour'], $rule['period_type']['toHour'], $excludingDays,$rule['period_type']['language'],$rule['period_type']['quantity'], $rule['period_type']['is_available']);
                    $queriedSlots = array_merge($queriedSlots,$arr);
                    break;
            }
        }

        foreach ($queriedSlots as $index => $queriedSlot) {
            foreach ($queriedSlots as $subindex => $subQueriedSlot) {
                if ($subindex >= $index || $queriedSlot['language'] !== $subQueriedSlot['language']) {
                    continue;
                }

                $start = new \DateTime($queriedSlot['start']);
                $end = new \DateTime($queriedSlot['end']);
                $subStart = new \DateTime($subQueriedSlot['start']);
                $subEnd = new \DateTime($subQueriedSlot['end']);

                if (($start <= $subStart) && ($end >= $subEnd)) {
                    unset($queriedSlots[$subindex]);
                }
            }
        }

        $dateRange = ['from' => $from, 'to' => $to];

        foreach ($user->settings->interval as $lang => $interval) {
            $availableTime = ['from' => $settings['working_hr_start'][$lang], 'to' => $settings['working_hr_end'][$lang]];
            $resFunc = $this->slotService->generateTimeSlots($dateRange, $availableTime, $excludingDays, $interval, $queriedSlots, $lang);
            $queriedSlots = array_merge($queriedSlots, $resFunc);
        }

        $mergedSlots = array_merge($queriedSlots, $availableSlots);

        usort($mergedSlots, function ($a, $b) {
            return $a['timestamp'] > $b['timestamp'];
        });

        $transformed = [];

        foreach ($mergedSlots as $slot) {
            if ($slot['start'] > Carbon::now()) {
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
                        if ($lang === $slot['language']) {
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
        }

        Redis::set('slots-' . $user->id . '-' . $hash, json_encode($transformed));

        return response()->json($transformed);
    }
}
