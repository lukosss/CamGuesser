<?php

namespace App\Domain\WindyApi\Service;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;


class WindyClient
{

    private const API_KEY = '9nStogxL7jBxQ2J5zd9utQyeqGROPCTE';

    private const GET_REQUEST_URL = 'https://api.windy.com/api/webcams/v2/list';

    private function httpWithHeaders(): PendingRequest
    {
        return Http::withHeaders([
            'x-windy-key' => self::API_KEY
        ]);
    }

    private function urlWithParameters($requestParameters = null): string
    {
        return self::GET_REQUEST_URL . $requestParameters;
    }

    private function getRequest($requestParameters): Response
    {
        return $this->httpWithHeaders()->get($this->urlWithParameters($requestParameters));
    }

    public function getAllCountries(): array
    {
        $response = $this->getRequest('?show=countries');
        $countries = $response->json()['result']['countries'];
        $filteredCountries = [];
        foreach ($countries as $country) {
            $filteredCountries[] = $country['name'];
        }
        return $filteredCountries;
    }

    public function getOneRandomCameraId(): int
    {
        $response = $this->getRequest('/orderby=random/limit=1');
        return $response->json()['result']['webcams'][0]['id'];
    }

    public function getRandomCameraPlayerEmbed(int $randomCameraId): string
    {
        $response = $this->getRequest("/webcam=$randomCameraId?show=webcams:player");
        return $response->json()['result']['webcams'][0]['player']['day']['embed'];
    }

    public function getDisplayedCameraCountry(int $randomCameraId): string
    {
        $response = $this->getRequest("/webcam=$randomCameraId?show=countries");
        return $response->json()['result']['countries'][0]['name'];
    }

}
