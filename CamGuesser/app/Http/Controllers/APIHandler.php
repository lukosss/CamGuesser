<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;


class APIHandler extends Controller
{
    public function connect(): bool
    {
        $response = Http::withHeaders([
            'x-windy-key' => '9nStogxL7jBxQ2J5zd9utQyeqGROPCTE'
        ])->get('https://api.windy.com/api/webcams/v2/list');
        return $response->ok();
    }

    public function getAllCountries(): array
    {
        $response = Http::withHeaders([
            'x-windy-key' => '9nStogxL7jBxQ2J5zd9utQyeqGROPCTE'
        ])->get('https://api.windy.com/api/webcams/v2/list?show=countries');
        return $response->json();
    }

    public function getOneRandomCameraId(): int
    {
        $response = Http::withHeaders([
            'x-windy-key' => '9nStogxL7jBxQ2J5zd9utQyeqGROPCTE'
        ])->get('https://api.windy.com/api/webcams/v2/list/orderby=random/limit=1');
        return $response->json()['result']['webcams'][0]['id'];
    }

    public function getRandomCameraPlayerEmbed(): string
    {
        $CamId = $this->getOneRandomCameraId();
        $response = Http::withHeaders([
            'x-windy-key' => '9nStogxL7jBxQ2J5zd9utQyeqGROPCTE'
        ])->get("https://api.windy.com/api/webcams/v2/list/webcam=$CamId?show=webcams:player");
        return $response->json()['result']['webcams'][0]['player']['day']['embed'];
    }

    public function index(): View
    {
        $url = $this->getRandomCameraPlayerEmbed();
        return view('welcome',compact('url'));
    }
}
