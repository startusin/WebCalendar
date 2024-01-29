<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Cookie::has('locale')) {
            $locale = Cookie::get('locale');
            App::setLocale($locale);
        } else {
            $locale = auth()->user()->settings->language;
            Cookie::queue(Cookie::forever('locale', $locale));
            App::setLocale($locale);
        }

       // dd(Session::get("locale"));
        return $next($request);
    }
}
