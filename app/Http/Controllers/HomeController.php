<?php

namespace App\Http\Controllers;

use App\Http\Resources\SlotResource;
use App\Models\AvailableSlot;
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
            'user' => $user,
        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function slots(User $user, Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $slots = $user->slots()
            ->whereDate('start_date', '>=', $from)
            ->whereDate('start_date', '<=', $to)
            ->get();

        return response()->json(SlotResource::collection($slots));
    }
}
