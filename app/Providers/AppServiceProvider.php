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
        config(['session.domain' => Request::getHost()]);

        $headers = App::make('request')->header('X-Forwarded-Host');

        if ($headers && !empty($headers)) {
            config(['session.domain' => '.' . $headers]);
        }
    }
}
