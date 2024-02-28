<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Models\Brunch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrunchController extends Controller
{
    public function index(Request $request)
    {
        $brunches = Brunch::where('calendar_id', $request->calendar_user->id)->get();

        return view('customer.brunch.index', compact('brunches'));
    }

    public function create()
    {
        return view('customer.brunch.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            "time" => ['required', 'string'],
            "price" => ['required', 'numeric'],
            "quantity" => ['required', 'numeric'],
            "excluded_days" =>['required', 'array']
        ])->validated();

        $data['calendar_id'] = $request->calendar_user->id;

        Brunch::create($data);

        return redirect()->route('customer.brunch.index');
    }

    public function delete($id)
    {
        $brunch = Brunch::findOrFail($id);
        $brunch->delete();

        return redirect()->route('customer.brunch.index');
    }

    public function edit(Brunch $brunch)
    {
        return view('customer.brunch.edit', compact('brunch'));
    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(),[
            'id' => ['required', 'exists:brunches,id'],
            "time" => ['required', 'string'],
            "price" => ['required', 'numeric'],
            "quantity" => ['required', 'numeric'],
            "excluded_days" =>['required', 'array']
        ])->validated();

        $data['calendar_id'] = $request->calendar_user->id;

        $brunch = Brunch::findOrFail($data['id']);
        $brunch->update($data);

        return redirect()->route('customer.brunch.index');
    }
}
