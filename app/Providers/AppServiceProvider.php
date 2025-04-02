<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\URL;

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
    public function boot()
    {
        Filament::serving(function () {
            // تأكد من أن Laravel يستخدم عنوان APP_URL الصحيح
            URL::forceRootUrl(config('app.url'));

            // السماح باستخدام نطاق Railway
            config(['session.domain' => parse_url(config('app.url'), PHP_URL_HOST)]);
        });
    }
}
