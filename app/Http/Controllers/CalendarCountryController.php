<?php

namespace App\Http\Controllers;

use App\Models\CalendarCountry;
use App\Models\Country;
use Illuminate\Http\Request;

class CalendarCountryController extends Controller
{
    public function index()
    {
        $id = auth()->user()->invited_by ?? auth()->user()->id;
        $countries = CalendarCountry::where('calendar_id', $id)->get();

        $allCountries = Country::all();
        if (count($countries) <= 0) {
            foreach ($allCountries as $item) {
                $country = CalendarCountry::create([
                    'calendar_id' => $id,
                    'country_id' => $item->id,
                    'is_enabled' => true
                ]);
            }

        }
        if (count($countries) > 0 && count($countries) != count($allCountries)) {
            foreach ($allCountries as $item) {
                if (!$countries->contains('country_id', $item->id)){
                    $country = CalendarCountry::create([
                        'calendar_id' => $id,
                        'country_id' => $item->id,
                        'is_enabled' => true
                    ]);
                }
            }
        }
        $countries = CalendarCountry::with('country')->where('calendar_id', $id)->orderBy('priority')->get();
        return view('customer.calendarCountry.index', compact('countries'));
    }

    public function getAllCountries()
    {
        $countries = Country::all();
        return view('customer.calendarCountry.AllCountry', compact('countries'));
    }

    public function setCountry(Request $request)
    {
        $data = $request->all();
        $calendarCountry = CalendarCountry::find($data['id']);
        if (!$calendarCountry) {
            abort(404);
        }
        $calendarCountry['is_enabled'] = $calendarCountry['is_enabled'] == false ? true : false;
        $calendarCountry->save();
        return response()->json(200);
    }

    public function changePriority(Request $request)
    {
        $data = $request->all();
        foreach ($data['idsArray'] as $key => $priority) {
            $country = CalendarCountry::find($key);
            if ($country) {
                $country['priority'] = $priority;
                $country->save();
            }
        }
        return response()->json('200');
    }
}
