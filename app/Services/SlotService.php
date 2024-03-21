<?php

namespace App\Services;

use Illuminate\Http\RedirectResponse;

class SlotService
{
    public function prepareSlot(array $data): RedirectResponse|array
    {
        if ($data['time_hour_start1'] > $data['time_hour_start2'] || ($data['time_hour_start1'] === $data['time_hour_start2'] && $data['time_minute_start1'] > $data['time_minute_start2'])) {
            return redirect()->back()
                ->withErrors(['custom_validation' => 'The final hour cannot be less than the initial hour'])
                ->withInput();
        }

        unset($data['_token']);

        $startDate = new \DateTime($data['datetimes']);
        $startDate->setTime($data['time_hour_start1'], $data['time_minute_start1']);

        $endDate = new \DateTime($data['datetimes']);
        $endDate->setTime($data['time_hour_start2'], $data['time_minute_start2']);

        return [
            'calendar_id' => auth()->user()->id,
            'language' => $data['language'],
            'attendee_qty' => $data['quantity'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_available' => $data['is_available']
        ];
    }

    public function generateTimeSlots($dateRange, $availableTime, $excludingDays, $intervalMinutes, $rewritingRules, $lang)
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
                        if ($rule['language'] == $lang) {
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

    public function generateWeeksSlots($from, $to, $startRangeWeek, $endRangeWeek, $fromHour, $toHour, $excludedDays, $language, $limit, $isAvailable) {
        $objects = [];
        $excludedDays = $this->transformDays($excludedDays);
        $startDate = new \DateTime($from);
        $endDate = new \DateTime($to);

        while ($startDate <= $endDate) {
            $currentWeekDay = $startDate->format('N');

            if ($currentWeekDay >= $startRangeWeek && $currentWeekDay <= $endRangeWeek && !in_array($currentWeekDay, $excludedDays)) {
                $startDateTime = new \DateTime($startDate->format('Y-m-d') . ' ' . $fromHour);
                $endDateTime = new \DateTime($startDate->format('Y-m-d') . ' ' . $toHour);
                $object = [
                    'start' => $startDateTime->format('Y-m-d\TH:i:s.u\Z'),
                    'end' => $endDateTime->format('Y-m-d\TH:i:s.u\Z'),
                    'timestamp' => $startDateTime->getTimestamp(),
                    'language' => $language,
                    'limit' => $limit,
                    'is_available' => $isAvailable
                ];

                $objects[] = $object;
            }

            $startDate->modify('+1 day');
        }
        return $objects;
    }

    public function generateMonthSlots($from, $to, $startRangeMonth, $endRangeMonth, $fromHour, $toHour, $excludedDays, $language, $limit, $isAvailable) {
        $objects = [];
        $excludedDays = $this->transformDays($excludedDays);
        $startDate = new \DateTime($from);
        $endDate = new \DateTime($to);

        while ($startDate <= $endDate) {
            $currentMonth = (int)$startDate->format('m');

            if ($currentMonth >= $startRangeMonth && $currentMonth <= $endRangeMonth) {
                $currentDayOfWeek = (int)$startDate->format('N');

                if (!in_array($currentDayOfWeek, $excludedDays)) {
                    $startDateTime = new \DateTime($startDate->format('Y-m-d') . ' ' . $fromHour);
                    $endDateTime = new \DateTime($startDate->format('Y-m-d') . ' ' . $toHour);
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

    public function generateCustomSlots($from, $to, $startCustomDate, $endCustomDate, $fromHour, $toHour, $excludedDays, $language, $limit, $isAvailable) {
        $objects = [];
        $excludedDays = $this->transformDays($excludedDays);
        $startDate = new \DateTime($from);
        $endDate = new \DateTime($to);
        $startCustomDateTime = new \DateTime($startCustomDate);
        $endCustomDateTime = new \DateTime($endCustomDate);

        while ($startDate <= $endDate) {
            if ($startDate >= $startCustomDateTime && $startDate <= $endCustomDateTime) {
                $currentWeekDay = $startDate->format('N');

                if (!in_array($currentWeekDay, $excludedDays)) {
                    $startDateTime = new \DateTime($startDate->format('Y-m-d') . ' ' . $fromHour);
                    $endDateTime = new \DateTime($startDate->format('Y-m-d') . ' ' . $toHour);
                    $object = [
                        'start' => $startDateTime->format('Y-m-d\TH:i:s.u\Z'),
                        'end' => $endDateTime->format('Y-m-d\TH:i:s.u\Z'),
                        'timestamp' => $startDateTime->getTimestamp(),
                        'language' => $language,
                        'limit' => $limit,
                        'is_available' => $isAvailable
                    ];

                    $objects[] = $object;
                }
            }

            $startDate->modify('+1 day');
        }

        return $objects;
    }

    private function transformDays($array) {
        $daysMap = [
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6,
            'sunday' => 7
        ];

        $transformedDays = [];

        foreach ($array as $day) {
            if (array_key_exists(strtolower($day), $daysMap)) {
                $transformedDays[] = $daysMap[strtolower($day)];
            }
        }

        return $transformedDays;
    }
}
