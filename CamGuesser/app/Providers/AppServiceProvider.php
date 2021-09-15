<?php

namespace App\Providers;

use App\Domain\WindyApi\Service\CountriesClient;
use App\Domain\WindyApi\Service\IdClient;
use App\Domain\WindyApi\UseCase\GetRandomCameraPlayerUseCase;
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
        $this->app->when(GetRandomCameraPlayerUseCase::class)
            ->needs('$apiKey')
            ->give(config('windy.api_key'));

        $this->app->when(IdClient::class)
            ->needs('$apiKey')
            ->give(config('windy.api_key'));

        $this->app->when(CountriesClient::class)
            ->needs('$apiKey')
            ->give(config('windy.api_key'));
    }
}
