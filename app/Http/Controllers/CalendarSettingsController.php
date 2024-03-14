<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Models\CalendarSettings;
use App\Models\FormSettings;
use App\Models\User;
use App\Services\FormsSettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CalendarSettingsController extends Controller
{
    private FormsSettingsService $formsSettingsService;
    public function __construct(FormsSettingsService $formsSettingsService)
    {
        $this->formsSettingsService = $formsSettingsService;
    }

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
        if ($settings['countries'] == null) {
            $settings['countries'] = ['France', 'English'];
            $settings->save();
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
            'alias' =>  'unique:users,alias,' . auth()->user()->id
        ])->validated();

        $oldData = CalendarSettings::where('calendar_id', $data['calendar_id'])->first();
        $user = User::find(auth()->user()->id);
        if ($user) {
            $user['alias'] = $data['alias'];
            $user->save();
        }
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

        if (isset($data['bg_image'])) {
            if ($oldData !=null &&$oldData['bg_image'] != null) {
                Storage::disk('public')->delete($oldData['bg_image']);
            }
            $data['bg_image'] = Storage::disk('public')->put('/images', $data['bg_image']);
        } elseif ( $oldData!=null &&$oldData['bg_image'] != null) {
            $data['bg_image'] = $oldData['bg_image'];
        }

        $calendarSettings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();
        $dataForUpdateOrCreate['calendar_id'] = $data['calendar_id'];
        $dataForUpdateOrCreate['primary_color'] = $data['primary_color'];
        $dataForUpdateOrCreate['working_hr_start'] = $workingHrStart;
        $dataForUpdateOrCreate['working_hr_end'] = $workingHrEnd;
        $dataForUpdateOrCreate['secondary_color'] = $data['secondary_color'];
        $dataForUpdateOrCreate['bg_color'] = $data['bg_color'];
        $dataForUpdateOrCreate['bg_image'] = $data['bg_image'] ?? null;
        $dataForUpdateOrCreate['logo'] = $data['logo'] ?? null;
        $dataForUpdateOrCreate['default_quantity'] = $Quantity;
        $dataForUpdateOrCreate['banner'] = $data['banner'] ?? null;
        $dataForUpdateOrCreate['excluded_days'] = $data['excluded_days'] ?? null;
        $dataForUpdateOrCreate['interval'] = $IntervalLang;
        $dataForUpdateOrCreate['language'] = $data['language'];
        $dataForUpdateOrCreate['vat'] = $data['vat'];

        if (!$calendarSettings) {
            $dataForUpdateOrCreate['countries'] = ['English', 'France'];
            CalendarSettings::create($dataForUpdateOrCreate);
        } else {
            $calendarSettings->update($dataForUpdateOrCreate);
        }

        $settings = FormSettings::where('calendar_id', auth()->user()->invited_by ?? auth()->user()->id)->get();
        $lenght = count( $settings);

        if ($lenght == 0) {
            $calendar_id =  auth()->user()->invited_by ?? auth()->user()->id;
            foreach ($this->formsSettingsService->GetAllKeys() as $key => $isRequired){
                FormSettings::create([
                    'key' => $key,
                    'is_required' => $isRequired,
                    'calendar_id' => $calendar_id
                ]);
            }
        }

        return redirect()->route('calendarSettings.edit');
    }

    public function embedded() {
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
            if ($settingsForm['is_required'] == 0){
                $settingsForm['is_required'] = 1;
            } else{
                $settingsForm['is_required'] = 0;
            }
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
        $FooterText = [];
        $PolicyTitle1 = [];
        $PolicyContent1 = [];

        $PolicyTitle2 = [];
        $PolicyContent2 = [];

        $PolicyTitle3 = [];
        $PolicyContent3 = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'footer_text') !== false) {
                $LangKey = explode("-", $key);
                $FooterText[$LangKey[0]] = $value;
            }

            if (strpos($key, 'policy_1_title') !== false) {
                $LangKey = explode("-", $key);
                $PolicyTitle1[$LangKey[0]] = $value;
            }

            if (strpos($key, 'policy_1_content') !== false) {
                $LangKey = explode("-", $key);
                $PolicyContent1[$LangKey[0]] = $value;
            }

            if (strpos($key, 'policy_2_title') !== false) {
                $LangKey = explode("-", $key);
                $PolicyTitle2[$LangKey[0]] = $value;
            }

            if (strpos($key, 'policy_2_content') !== false) {
                $LangKey = explode("-", $key);
                $PolicyContent2[$LangKey[0]] = $value;
            }

            if (strpos($key, 'policy_3_title') !== false) {
                $LangKey = explode("-", $key);
                $PolicyTitle3[$LangKey[0]] = $value;
            }

            if (strpos($key, 'policy_3_content') !== false) {
                $LangKey = explode("-", $key);
                $PolicyContent3[$LangKey[0]] = $value;
            }
        }
        $Policy1 = [
            'title' => $PolicyTitle1,
            'content' => $PolicyContent1,
        ];
        $Policy2 = [
            'title' => $PolicyTitle2,
            'content' => $PolicyContent2,
        ];
        $Policy3 = [
            'title' => $PolicyTitle3,
            'content' => $PolicyContent3,
        ];
        $settings = CalendarSettings::where('calendar_id', auth()->user()->ivited_by??auth()->user()->id)->first();
        $settings->footer_text = $FooterText;
        $settings->policy_1 = $Policy1;
        $settings->policy_2 = $Policy2;
        $settings->policy_3 = $Policy3;
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
        if (!$settings)
        {
            abort(404);
        }
        $settings['custom_styles'] = $data['custom_styles']??"";
        $settings['custom_script'] = $data['custom_script']??"";
        $settings->save();
        return redirect()->back();
    }
}
