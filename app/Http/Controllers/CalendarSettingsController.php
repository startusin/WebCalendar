<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Models\CalendarSettings;
use App\Models\FormSettings;
use App\Models\User;
use App\Services\FormsSettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CalendarSettingsController extends Controller
{
    private FormsSettingsService $formsSettingsService;

    public function __construct(FormsSettingsService $formsSettingsService)
    {
        $this->formsSettingsService = $formsSettingsService;
    }

    public function deleteCountry(Request $request)
    {
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

    public function storeCountry(Request $request)
    {
        $country = $request->input('country');

        if ($country) {
            $settings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();
            $countriesArray = $settings['countries'] ?? [];

            array_push($countriesArray, $country);

            $settings['countries'] = $countriesArray;
            $settings->save();
        }

        return redirect()->route('calendarSettings.edit');
    }

    public function createCountry()
    {
        return view('customer.calendarSettings.createCountry');
    }

    public function edit()
    {
        $langs = Languages::getUserLanguages(auth()->user()->languages);
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

        if ($settings['countries'] == null) {
            $settings['countries'] = ['France', 'English'];
            $settings->save();
        }

        return view('customer.calendarSettings.edit', compact('settings', 'langs'));
    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(), [
            'calendar_id' => ['required', 'numeric'],
            'primary_color' => ['string'],
            'secondary_color' => ['string'],
            'bg_color' => ['string'],
            'logo' => ['file'],
            'bg_image' => ['file'],
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
            'vat' => ['numeric'],
            'alias' => 'unique:users,alias,' . auth()->user()->id
        ])->validated();

        $redisKeys = Redis::keys('slots-' . $data['calendar_id'] . '-*');

        if (!empty($redisKeys)) {
            foreach ($redisKeys as $redisKey) {
                Redis::del(str_replace('laravel_database_', '', $redisKey));
            }
        }

        $oldData = CalendarSettings::where('calendar_id', $data['calendar_id'])->first();
        $user = User::find(auth()->user()->id);

        if ($user) {
            $user['alias'] = $data['alias'];
            $user->save();
        }

        $intervalLang = [];
        $quantity = [];
        $workingHrStart = [];
        $workingHrEnd = [];

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'interval')) {
                $langKey = explode("-", $key);
                $intervalLang[$langKey[0]] = $value;
            }
        }

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'default_quantity')) {
                $langKey = explode("-", $key);
                $quantity[$langKey[0]] = $value;
            }
        }

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'working_hr_start')) {
                $langKey = explode("-", $key);
                $workingHrStart[$langKey[0]] = $value;
            }
        }

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'working_hr_end')) {
                $langKey = explode("-", $key);
                $workingHrEnd[$langKey[0]] = $value;
            }
        }

        if (isset($data['logo'])) {
            if ($oldData && $oldData['logo']) {
                Storage::disk('public')->delete($oldData['logo']);
            }

            $data['logo'] = Storage::disk('public')->put('/images', $data['logo']);
        } elseif ($oldData && $oldData['logo']) {
            $data['logo'] = $oldData['logo'];
        }
        if (isset($data['banner'])) {
            if ($oldData && $oldData['banner']) {
                Storage::disk('public')->delete($oldData['banner']);
            }

            $data['banner'] = Storage::disk('public')->put('/images', $data['banner']);
        } elseif ($oldData && $oldData['banner']) {
            $data['banner'] = $oldData['banner'];
        }

        if (isset($data['bg_image'])) {
            if ($oldData && $oldData['bg_image']) {
                Storage::disk('public')->delete($oldData['bg_image']);
            }

            $data['bg_image'] = Storage::disk('public')->put('/images', $data['bg_image']);
        } elseif ($oldData && $oldData['bg_image']) {
            $data['bg_image'] = $oldData['bg_image'];
        }

        $calendarSettings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();

        $calendarSettingsData = [
            'calendar_id' => $data['calendar_id'],
            'primary_color' => $data['primary_color'],
            'working_hr_start' => $workingHrStart,
            'working_hr_end' => $workingHrEnd,
            'secondary_color' => $data['secondary_color'],
            'bg_color' => $data['bg_color'],
            'bg_image' => $data['bg_image'] ?? null,
            'logo' => $data['logo'] ?? null,
            'default_quantity' => $quantity,
            'banner' => $data['banner'] ?? null,
            'excluded_days' => $data['excluded_days'] ?? null,
            'interval' => $intervalLang,
            'language' => $data['language'],
            'vat' => $data['vat']
        ];

        if (!$calendarSettings) {
            $calendarSettingsData['countries'] = ['English', 'France'];
            CalendarSettings::create($calendarSettingsData);
        } else {
            $calendarSettings->update($calendarSettingsData);
        }

        $settings = FormSettings::where('calendar_id', auth()->user()->invited_by ?? auth()->user()->id)->get();

        if (count($settings) <= 0) {
            $calendar_id = auth()->user()->invited_by ?? auth()->user()->id;

            foreach ($this->formsSettingsService->getFields() as $key => $value) {
                FormSettings::create([
                    'key' => $key,
                    'is_required' => $value,
                    'calendar_id' => $calendar_id
                ]);
            }
        }

        return redirect()->route('calendarSettings.edit');
    }

    public function embedded()
    {
        return view('customer.calendarSettings.embedded');
    }

    public function getFormsSettings()
    {
        $settings = FormSettings::where('calendar_id', auth()->user()->invited_by ?? auth()->user()->id)->get();

        return view('customer.formSettings.index', compact('settings'));
    }

    public function changeFormSettings(Request $request)
    {
        $data = $request->all();
        $settingsForm = FormSettings::find($data['id']);

        if ($settingsForm) {
            $settingsForm['is_required'] = (int)!$settingsForm['is_required'];
            $settingsForm->save();
        }

        return response()->json(200);
    }

    public function getPrivacy()
    {
        $settings = CalendarSettings::where('calendar_id', auth()->user()->invited_by ?? auth()->user()->id)->first();

        return view('customer.privacy.index', compact('settings'));
    }

    public function setPrivacy(Request $request)
    {
        $footerText = [];
        $policyTitle1 = [];
        $policyContent1 = [];
        $policyTitle2 = [];
        $policyContent2 = [];
        $policyTitle3 = [];
        $policyContent3 = [];

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'footer_text')) {
                $langKey = explode("-", $key);
                $footerText[$langKey[0]] = $value;
            }

            if (str_contains($key, 'policy_1_title')) {
                $langKey = explode("-", $key);
                $policyTitle1[$langKey[0]] = $value;
            }

            if (str_contains($key, 'policy_1_content')) {
                $langKey = explode("-", $key);
                $policyContent1[$langKey[0]] = $value;
            }

            if (str_contains($key, 'policy_2_title')) {
                $langKey = explode("-", $key);
                $policyTitle2[$langKey[0]] = $value;
            }

            if (str_contains($key, 'policy_2_content')) {
                $langKey = explode("-", $key);
                $policyContent2[$langKey[0]] = $value;
            }

            if (str_contains($key, 'policy_3_title')) {
                $langKey = explode("-", $key);
                $policyTitle3[$langKey[0]] = $value;
            }

            if (str_contains($key, 'policy_3_content')) {
                $langKey = explode("-", $key);
                $policyContent3[$langKey[0]] = $value;
            }
        }

        $policy1 = [
            'title' => $policyTitle1,
            'content' => $policyContent1,
        ];

        $policy2 = [
            'title' => $policyTitle2,
            'content' => $policyContent2,
        ];

        $policy3 = [
            'title' => $policyTitle3,
            'content' => $policyContent3,
        ];

        $settings = CalendarSettings::where('calendar_id', auth()->user()->ivited_by ?? auth()->user()->id)->first();
        $settings->footer_text = $footerText;
        $settings->policy_1 = $policy1;
        $settings->policy_2 = $policy2;
        $settings->policy_3 = $policy3;
        $settings->save();

        return redirect()->back();
    }


    public function getStyles()
    {
        $settings = CalendarSettings::where('calendar_id', auth()->user()->invited_by ?? auth()->user()->id)->first();

        return view('customer.styles.index', compact('settings'));
    }

    public function setStyles(Request $request)
    {
        $data = $request->all();

        $settings = CalendarSettings::where('calendar_id', $data['calendar_id'])->first();

        if (!$settings) {
            abort(404);
        }

        $settings['custom_styles'] = $data['custom_styles'] ?? '';
        $settings['custom_script'] = $data['custom_script'] ?? '';
        $settings->save();

        return redirect()->back();
    }
}
