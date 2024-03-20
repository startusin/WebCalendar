<?php

namespace App\Http\Controllers;

use App\Emails\InvitedEmail;
use App\Enums\Languages;
use App\Models\Brunch;
use App\Models\CalendarSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        $team = User::where('invited_by', auth()->user()->id)->get();

        return view('customer.team.index', compact('team'));
    }

    public function create()
    {
        return view('customer.team.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            "email" => ['required', 'string'],
            "first_name" => ['required', 'string'],
            "last_name" => ['required', 'string'],
            "excluded_permissions" => ['array']
        ])->validated();

        $password = Str::random(10);

        $user = new User();
        $user->role = 'invited';
        $user->password = Hash::make($password);
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->invited_by = auth()->user()->id;
        $user->excluded_permissions = $request->excluded_permissions;
        $user->save();

        $settings = CalendarSettings::where('calendar_id', auth()->user()->id)->first();

        Mail::to($request->email)->send(new InvitedEmail(
            'You have been invited to the calendar',
            'You have been invited to the calendar. Your login: ' . $request->email . ', Password: ' . $password,
            $settings->main_email,
            $settings->main_name
        ));

        return redirect()->route('customer.team.index');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('customer.team.index');
    }

    public function edit(User $user)
    {
        return view('customer.team.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(), [
            'id' => ['required', 'exists:users,id'],
            "email" => ['required', 'string'],
            "first_name" => ['required', 'string'],
            "last_name" => ['required', 'string'],
            "excluded_permissions" => ['array']
        ])->validated();

        if (!isset($data['excluded_permissions'])) {
            $data['excluded_permissions'] = [];
        }

        $user = User::findOrFail($data['id']);
        $user->update($data);

        return redirect()->route('customer.team.index');
    }
}
