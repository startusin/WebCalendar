<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $products = $user->products;
        $slots = $user->slots;

        return view('index', [
            'products' => $products,
            'slots' => $slots,
        ]);
    }
}
