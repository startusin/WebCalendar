<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Models\CalendarSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CalendarSettingsController extends Controller
{
    public function edit() {
        $langs = Languages::getMyLanguages(auth()->user()->languages);
        $settings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();

        if (!$settings) {
            $settings['primary_color'] = '#CCA646';
            $settings['secondary_color'] = '#E9D9A7';
            $settings['bg_color'] = '#FCF6E8';
            $settings['working_hr_start'] = '8:00';
            $settings['working_hr_end'] = '20:00';
            $settings['excluded_days'] = ['saturday', 'sunday'];
            $settings['logo'] = null;
            $settings['brunch_text'] = null;
            foreach ($langs as $key => $lang) {
                $settings['interval'][$key] = 60;
                $settings['default_quantity'][$key] = 3;
                $settings['working_hr_start'][$key] = '08:00';
                $settings['working_hr_end'][$key] = '20:00';
            }
            $settings['language'] = 'en';
        }

        return view('customer.calendarSettings.edit', compact('settings', 'langs'));
    }

    public function update(Request $request) {

        $data = Validator::make($request->all(), [
            'calendar_id' => ['required', 'numeric'],
            'primary_color' => ['string'],
            'secondary_color' => ['string'],
            'bg_color' => ['string'],
            'logo' => ['file'],
            'en-default_quantity' => ['numeric'],
            'fr-default_quantity' => ['numeric'],
            'es-default_quantity' => ['numeric'],
            'en-working_hr_start' => ['string'],
            'fr-working_hr_start' => ['string'],
            'es-working_hr_start' => ['string'],
            'en-working_hr_end' => ['string'],
            'fr-working_hr_end' => ['string'],
            'es-working_hr_end' => ['string'],
            'banner' => ['file'],
            'excluded_days' => ['required', 'array'],
            'en-interval' => ['numeric'],
            'fr-interval' => ['numeric'],
            'es-interval' => ['numeric'],
            'language' => ['string'],
        ])->validated();

        $oldData = CalendarSettings::where('calendar_id', $data['calendar_id'])->first();

        $IntervalLang = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'interval') !== false) {
                $LangKey = explode("-", $key);
                $IntervalLang[$LangKey[0]] = $value;
            }
        }

        $Quantity = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'default_quantity') !== false) {
                $LangKey = explode("-", $key);
                $Quantity[$LangKey[0]] = $value;
            }
        }

        $workingHrStart = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'working_hr_start') !== false) {
                $LangKey = explode("-", $key);
                $workingHrStart[$LangKey[0]] = $value;
            }
        }

        $workingHrEnd = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'working_hr_end') !== false) {
                $LangKey = explode("-", $key);
                $workingHrEnd[$LangKey[0]] = $value;
            }
        }

        if (isset($data['logo'])) {
            if ($oldData !=null &&$oldData['logo'] != null) {
                Storage::disk('public')->delete($oldData['logo']);
            }
            $data['logo'] = Storage::disk('public')->put('/images', $data['logo']);
        } elseif ( $oldData!=null &&$oldData['logo'] != null) {
            $data['logo'] = $oldData['logo'];
            var_dump($data['logo']);
        }
        if (isset($data['banner'])) {
            if ($oldData !=null &&$oldData['banner'] != null) {
                Storage::disk('public')->delete($oldData['banner']);
            }
            $data['banner'] = Storage::disk('public')->put('/images', $data['banner']);
        } elseif ( $oldData!=null &&$oldData['banner'] != null) {
            $data['banner'] = $oldData['banner'];
        }

        CalendarSettings::updateOrCreate([
            'calendar_id' => auth()->user()->id
        ],[
            'calendar_id' => $data['calendar_id'],
            'primary_color' => $data['primary_color'],
            'working_hr_start' => $workingHrStart,
            'working_hr_end' => $workingHrEnd,
            'secondary_color' => $data['secondary_color'],
            'bg_color' => $data['bg_color'],
            'logo' => $data['logo'] ?? null,
            'default_quantity' => $Quantity,
            'banner' => $data['banner'] ?? null,
            'excluded_days' => $data['excluded_days'] ?? null,
            'interval' => $IntervalLang,
            'language' => $data['language'],
        ]);

        return redirect()->route('calendarSettings.edit');
    }

    public function embedded() {
        return view('customer.calendarSettings.embedded');
    }
}
