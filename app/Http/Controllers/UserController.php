<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Enums\Role;
use App\Http\Requests\User\UpdateRequest;
use App\Models\CalendarCountry;
use App\Models\CalendarSettings;
use App\Models\Country;
use App\Models\FormSettings;
use App\Models\Translations;
use App\Models\User;
use App\Services\FormsSettingsService;
use App\Services\LangService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $langService;
    private FormsSettingsService $formsSettingsService;

    public function __construct(LangService $langService, FormsSettingsService $formsSettingsService)
    {
        $this->langService = $langService;
        $this->formsSettingsService = $formsSettingsService;

    }

    public function index() {
        $users = User::where('role', Role::customer)
                ->get();
        return view('admin.user.index', compact('users'));
    }

    public function create() {
        $languages = Languages::getLanguages();
        return view('admin.user.create', compact('languages'));
    }
    public function store(Request $request) {
        $data = Validator::make($request->all(), [
            "first_name" => ['required', 'string'],
            "last_name" => ['required', 'string'],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => ['required', 'string'],
            "languages" =>['required', 'array'],
        ])->validated();

        $data['role'] = Role::customer;
        $user = User::create($data);
        $user['alias'] = $user->id;
        $user->save();


        $AllCountries = Country::all();
            foreach ($AllCountries as $item) {
                $country = CalendarCountry::create([
                    'calendar_id' => $user->id,
                    'country_id' => $item->id,
                    'is_enabled' => true
                ]);
            }
        $translations = [];
        foreach ($user->languages as $item) {
            switch ($item) {
                case "en":
                    $this->langService->EnglishWords($translations);
                    break;
                case "fr":
                    $this->langService->FranceWords($translations);
                    break;
            }
        }
        Translations::create([
            'calendar_id' => $user->id,
            'translations' => $translations,
        ]);

        $settings = [];
        $settings['calendar_id'] = $user->id;
        $settings['primary_color'] = '#CCA646';
        $settings['secondary_color'] = '#E9D9A7';
        $settings['bg_color'] = '#FCF6E8';
        $settings['excluded_days'] = ['saturday', 'sunday'];
        $settings['logo'] = null;
        $settings['brunch_text'] = null;
        foreach (Languages::getMyLanguages($user->languages) as $key => $lang) {
            $settings['interval'][$key] = 60;
            $settings['default_quantity'][$key] = 3;
            $settings['working_hr_start'][$key] = '08:00';
            $settings['working_hr_end'][$key] = '20:00';
        }
        $settings['language'] = $user->languages[0];
        CalendarSettings::create($settings);

        foreach ($this->formsSettingsService->GetAllKeys() as $key => $isRequired){
            FormSettings::create([
                'key' => $key,
                'is_required' => $isRequired,
                'calendar_id' => $user->id
            ]);
        }
        return redirect()->route('admin.user.index');
    }

    public function show(User $user)
    {
        $user['languages'] = implode(', ', array_keys(array_flip(Languages::getMyLanguages($user->languages))));
        return $user;
    }

    public function edit(User $user)
    {
        $languages = Languages::getLanguages();
        return view('admin.user.edit', compact('user','languages'));
    }

    public function update(UpdateRequest $request)
    {
        $data = Validator::make($request->all(), [
            'user_id'=> ['required'],
            "first_name" => ['required', 'string'],
            "last_name" => ['required', 'string'],
            "email" => ['required', 'email', Rule::unique('users', 'email')->ignore($request->user_id)],
            "password" => [''],
            "languages" =>['required', 'array']
        ])->validated();
        $user = User::find($data['user_id']);
        if(!$user) {
            abort(404);
        }
        if ($data['password'] == null) {
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->route('admin.user.index');
    }
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index');
    }
}
