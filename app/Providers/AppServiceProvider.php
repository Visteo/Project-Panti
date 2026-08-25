<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureViewData();
        $this->configureRateLimiting();
    }

    private function configureViewData(): void
    {
        View::composer('frontend.*', function ($view) {
            $siteSetting = Schema::hasTable('settings')
                ? Setting::first()
                : null;

            $view->with(
                'siteSetting',
                $siteSetting
            );
        });
    }

    private function configureRateLimiting(): void
    {
        RateLimiter::for(
            'admin-login',
            function (Request $request) {
                $email = Str::lower(
                    (string) $request->input('email')
                );

                return [
                    Limit::perMinute(5)
                        ->by($email . '|' . $request->ip()),

                    Limit::perHour(20)
                        ->by('hour|' . $email . '|' . $request->ip()),
                ];
            }
        );

        RateLimiter::for(
            'donation-submission',
            function (Request $request) {
                return [
                    Limit::perMinute(5)
                        ->by($request->ip()),

                    Limit::perHour(30)
                        ->by('hour|' . $request->ip()),
                ];
            }
        );
    }
}