<?php

namespace App\Domain\WindyApi\Service;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;


class WindyClient
{

    private const API_KEY = '9nStogxL7jBxQ2J5zd9utQyeqGROPCTE';
    private const BASE_URL = 'https://api.windy.com/api/webcams/v2/list';

    private function httpClientWithHeaders(): PendingRequest
    {
        return Http::withHeaders([
            'x-windy-key' => self::API_KEY
        ]);
    }

    private function baseUrlWithEndpoint($apiEndpoint = null): string
    {
        return self::BASE_URL . $apiEndpoint;
    }

    public function getRequest($apiEndpoint): Response
    {
        return $this->httpClientWithHeaders()->get($this->baseUrlWithEndpoint($apiEndpoint));
    }

}
