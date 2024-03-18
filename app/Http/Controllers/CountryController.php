<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin.country.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.country.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $name = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'name') !== false) {
                $LangKey = explode("-", $key);
                $name[$LangKey[0]] = $value;
            }
        }
        Country::create([
            'name' => $name,
            "numeric_code" => $data['numeric_code'],
            "alpha_code" => $data['alpha_code'],
            "full_alpha_code" => $data['full_alpha_code'],
        ]);

        return redirect()->route('admin.country.index');
    }


    public function edit(Country $country)
    {
        return view('admin.country.edit', compact('country'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $name = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'name') !== false) {
                $LangKey = explode("-", $key);
                $name[$LangKey[0]] = $value;
            }
        }
        $countryForUpdate['name'] = $name;
        $countryForUpdate["numeric_code"] = $data['numeric_code'];
        $countryForUpdate["alpha_code"] = $data['alpha_code'];
        $countryForUpdate["full_alpha_code"] = $data['full_alpha_code'];
        $country = Country::find($data['id']);
        if (!$country) {
            abort(404);
        }
        $country->update($countryForUpdate);
        $country->save();
        return redirect()->route('admin.country.index');
    }

    public function delete(Country $country) {
        $country->delete();
        return redirect()->route('admin.country.index');
    }
}
