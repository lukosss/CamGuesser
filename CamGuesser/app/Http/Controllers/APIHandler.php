<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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
}
