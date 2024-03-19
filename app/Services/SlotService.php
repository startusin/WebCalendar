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
}
