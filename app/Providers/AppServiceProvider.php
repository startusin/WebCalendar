<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $cookieDomain = env('MAIN_COOKIE_DOMAIN');

        config(['session.domain' => $cookieDomain]);

        $headers = App::make('request')->header('X-Forwarded-Host');

        if ($headers && !empty($headers) && !str_contains($headers, $cookieDomain)) {
            config(['session.domain' => '.' . $headers]);
        }
    }
}
