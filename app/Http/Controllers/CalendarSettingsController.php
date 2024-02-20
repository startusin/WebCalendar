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
    public function deleteCountry(Request $request) {
        $country = $request->input('country');
        $settings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();
        $countriesArray = $settings['countries'] ?? [];
        $index = array_search($country, $countriesArray);

        if ($index !== false) {
            unset($countriesArray[$index]);
        }

        $settings->countries = $countriesArray;
        $settings->save();
        return response()->json(['message' => 'Country deleted successfully'], 200);
    }

    public function storeCountry(Request $request) {
        $country = $request->input('country');
        if ($country != null) {
            $settings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();
            $countriesArray = $settings['countries'] ?? [];
            array_push($countriesArray, $country);
            $settings['countries'] = $countriesArray;
            $settings->save();
        }
        return redirect()->route('calendarSettings.edit');
    }

    public function createCountry() {
        return view('customer.calendarSettings.CreateCountry');
    }

    public function edit() {
        $langs = Languages::getMyLanguages(auth()->user()->languages);
        $settings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();

        if (!$settings) {
            $settings['primary_color'] = '#CCA646';
            $settings['secondary_color'] = '#E9D9A7';
            $settings['bg_color'] = '#FCF6E8';
            $settings['excluded_days'] = ['saturday', 'sunday'];
            $settings['logo'] = null;
            $settings['brunch_text'] = null;
            foreach ($langs as $key => $lang) {
                $settings['interval'][$key] = 60;
                $settings['default_quantity'][$key] = 3;
                $settings['working_hr_start'][$key] = '08:00';
                $settings['working_hr_end'][$key] = '20:00';
            }
            $settings['countries'] = ['France', 'English'];
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

        $calendarSettings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();
        $dataForUpdateOrCreate['calendar_id'] = $data['calendar_id'];
        $dataForUpdateOrCreate['primary_color'] = $data['primary_color'];
        $dataForUpdateOrCreate['working_hr_start'] = $workingHrStart;
        $dataForUpdateOrCreate['working_hr_end'] = $workingHrEnd;
        $dataForUpdateOrCreate['secondary_color'] = $data['secondary_color'];
        $dataForUpdateOrCreate['bg_color'] = $data['bg_color'];
        $dataForUpdateOrCreate['logo'] = $data['logo'] ?? null;
        $dataForUpdateOrCreate['default_quantity'] = $Quantity;
        $dataForUpdateOrCreate['banner'] = $data['banner'] ?? null;
        $dataForUpdateOrCreate['excluded_days'] = $data['excluded_days'] ?? null;
        $dataForUpdateOrCreate['interval'] = $IntervalLang;
        $dataForUpdateOrCreate['language'] = $data['language'];

        if (!$calendarSettings) {
            $dataForUpdateOrCreate['countries'] = ['English', 'France'];
            CalendarSettings::create($dataForUpdateOrCreate);
        } else {
            $calendarSettings->update($dataForUpdateOrCreate);
        }

        return redirect()->route('calendarSettings.edit');
    }

    public function embedded() {
        return view('customer.calendarSettings.embedded');
    }
}
