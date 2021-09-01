<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;


class APIController extends Controller
{

    private const API_KEY = '9nStogxL7jBxQ2J5zd9utQyeqGROPCTE';

    private const GET_REQUEST_URL = 'https://api.windy.com/api/webcams/v2/list';

    private function httpWithHeaders(): PendingRequest
    {
        return Http::withHeaders([
            'x-windy-key' => self::API_KEY
        ]);
    }

    private function getRequestToApi($requestParameters = null): string
    {
        if ($requestParameters === null) {
            return self::GET_REQUEST_URL;
        }

        return self::GET_REQUEST_URL . $requestParameters;
    }

    public function getAllCountries() : array
    {
        $response = $this->httpWithHeaders()->get($this->getRequestToApi('?show=countries'));
        $countries = $response->json()['result']['countries'];
        $filteredCountries = [];
        foreach ($countries as $country)
        {
            $filteredCountries[] = $country['name'];
        }
        return $filteredCountries;
    }

    public function getOneRandomCameraId(): int
    {
        $response = $this->httpWithHeaders()->get($this->getRequestToApi('/orderby=random/limit=1'));
        return $response->json()['result']['webcams'][0]['id'];
    }

    public function getRandomCameraPlayerEmbed(int $randomCameraId): string
    {
        $response = $this->httpWithHeaders()->get($this->getRequestToApi("/webcam=$randomCameraId?show=webcams:player"));
        return $response->json()['result']['webcams'][0]['player']['day']['embed'];
    }

    public function getDisplayedCameraCountry(int $randomCameraId): string
    {
        $response = $this->httpWithHeaders()->get($this->getRequestToApi("/webcam=$randomCameraId?show=countries"));
        return $response->json()['result']['countries'][0]['name'];
    }

}

