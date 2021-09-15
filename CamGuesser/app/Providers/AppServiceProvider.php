<?php

namespace App\Providers;

use App\Domain\Camera\Service\CameraClient;
use App\Domain\Country\Service\CountryClient;
use App\Domain\WindyApi\Service\IdClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->when(CameraClient::class)
            ->needs('$apiKey')
            ->give(config('windy.api_key'));

        $this->app->when(IdClient::class)
            ->needs('$apiKey')
            ->give(config('windy.api_key'));

        $this->app->when(CountryClient::class)
            ->needs('$apiKey')
            ->give(config('windy.api_key'));
    }
}
