<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LocalizationController extends Controller
{
    public function setLang($locale)
    {
        App::setLocale($locale);
        Cookie::queue(Cookie::forever('locale', $locale));

        return redirect()->back();
    }

    public function getCurrentLanguage()
    {
        $locale = 'en';

        if (Cookie::has('locale')) {
            $locale = Cookie::get('locale');
        }

        return $locale;
    }
}
