<?php

namespace App\Http\Controllers;

use App\Enums\Languages;
use App\Enums\Role;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
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
            "languages" =>['required', 'array']
        ])->validated();

        $data['role'] = Role::customer;
        User::create($data);

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
        $data = $request->validated();

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
