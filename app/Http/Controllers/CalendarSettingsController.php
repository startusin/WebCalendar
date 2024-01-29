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
            $settings['default_quantity'] = 3;
            $settings['brunch_text'] = null;
            $settings['interval'] = 60;
            $settings['language'] = 'en';
        }

        return view('customer.calendarSettings.edit', compact('settings', 'langs'));
    }

    public function update(Request $request) {

        $data = Validator::make($request->all(), [
            'calendar_id' => ['required', 'numeric'],
            'primary_color' => ['string'],
            'brunch_text' => ['string'],
            'secondary_color' => ['string'],
            'working_hr_start' => ['string'],
            'working_hr_end' => ['string'],
            'bg_color' => ['string'],
            'logo' => ['file'],
            'default_quantity' => ['numeric'],
            'banner' => ['file'],
            'excluded_days' => ['required', 'array'],
            'interval' => ['numeric'],
            'language' => ['string'],
        ])->validated();

        $oldData = CalendarSettings::where('calendar_id', $data['calendar_id'])->first();


        $BrunchTextL = [];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'brunch_text') !== false) {
                $LangKey = explode("_", $key);
                $BrunchTextL[$LangKey[0]] = $value;
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
            'working_hr_start' => $data['working_hr_start'],
            'working_hr_end' => $data['working_hr_end'],
            'brunch_text' => $BrunchTextL,
            'secondary_color' =>$data['secondary_color'],
            'bg_color' => $data['bg_color'],
            'logo' => $data['logo'] ?? null,
            'default_quantity' => $data['default_quantity'],
            'banner' => $data['banner'] ?? null,
            'excluded_days' => $data['excluded_days'] ?? null,
            'interval' => $data['interval'],
            'language' => $data['language'],
        ]);

        return redirect()->route('calendarSettings.edit');
    }

    public function embedded() {
        return view('customer.calendarSettings.embedded');
    }
}
