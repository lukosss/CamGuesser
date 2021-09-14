<?php


namespace App\Domain\WindyApi\UseCase;

use App\Domain\WindyApi\Service\WindyClient;

class GetRandomCameraPlayerUseCase
{
    private WindyClient $client;

    public function __construct(WindyClient $client)
    {
        $this->client = $client;
    }

    public function get(int $randomCameraId): string
    {
        $response = $this->client->getRequest("/webcam=$randomCameraId?show=webcams:player");
        return $response->json()['result']['webcams'][0]['player']['day']['embed'];
    }
}
