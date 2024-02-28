<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role == 'customer' || auth()->user()->role == 'invited') {
            $calendarUser = auth()->user();

            if ($calendarUser->role === 'invited') {
                $calendarUser = User::findOrFail($calendarUser->invited_by);
            }

            request()->merge(['calendar_user' => $calendarUser]);

            return $next($request);
        }
        return abort(404);
    }
}
