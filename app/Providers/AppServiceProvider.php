<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        //$this->register();

        Passport::tokensExpireIn(CarbonInterval::minutes(1));
        Passport::refreshTokensExpireIn(CarbonInterval::minutes(1));
        Passport::personalAccessTokensExpireIn(CarbonInterval::minutes(1));
    }
}
