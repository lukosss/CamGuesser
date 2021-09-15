<?php

namespace App\Providers;

use App\Domain\WindyApi\UseCase\GetOneRandomCameraIdUseCase;
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

        $this->app->when(GetOneRandomCameraIdUseCase::class)
            ->needs('$apiKey')
            ->give(config('windy.api_key'));
    }
}
