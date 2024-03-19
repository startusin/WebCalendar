<?php

namespace App\Services;

use App\Models\CustomSlot;
use DateTime;

class SlotService
{
    public function makeSlotForCreate(array $data): array|\Illuminate\Http\RedirectResponse
    {
        if ($data['time_hour_start1'] > $data['time_hour_start2'] ||
            ($data['time_hour_start1'] == $data['time_hour_start2'] && $data['time_minute_start1'] > $data['time_minute_start2'])) {
            return redirect()->back()
                ->withErrors(['custom_validation' => 'The final hour cannot be less than the initial hour'])
                ->withInput();
        }
        unset($data['_token']);
        $dateTime1 = new DateTime($data['datetimes']);
        $dateTime1->setTime($data['time_hour_start1'],$data['time_minute_start1']);

        $dateTime2 = new DateTime($data['datetimes']);
        $dateTime2->setTime($data['time_hour_start2'],$data['time_minute_start2']);

        $dataForCreate['calendar_id'] = auth()->user()->id;
        $dataForCreate['language'] = $data['language'];
        $dataForCreate['attendee_qty'] = $data['quantity'];
        $dataForCreate['start_date'] = $dateTime1;
        $dataForCreate['end_date'] = $dateTime2;
        $dataForCreate['is_available'] = $data['is_available'];

        return $dataForCreate;
    }

    public function makeSlotForUpdate(array $data): array|\Illuminate\Http\RedirectResponse
    {
        if ($data['time_hour_start1'] > $data['time_hour_start2'] ||
            ($data['time_hour_start1'] == $data['time_hour_start2'] && $data['time_minute_start1'] > $data['time_minute_start2'])) {
            return redirect()->back()
                ->withErrors(['custom_validation' => 'The final hour cannot be less than the initial hour'])
                ->withInput();
        }
        $dateTime1 = new DateTime($data['datetimes']);
        $dateTime1->setTime($data['time_hour_start1'],$data['time_minute_start1']);

        $dateTime2 = new DateTime($data['datetimes']);
        $dateTime2->setTime($data['time_hour_start2'],$data['time_minute_start2']);


        $dataForUpdate['calendar_id'] = auth()->user()->id;
        $dataForUpdate['language'] = $data['language'];
        $dataForUpdate['attendee_qty'] = $data['quantity'];
        $dataForUpdate['start_date'] = $dateTime1;
        $dataForUpdate['end_date'] = $dateTime2;
        $dataForUpdate['is_available'] = $data['is_available'];
        return $dataForUpdate;
    }
}
