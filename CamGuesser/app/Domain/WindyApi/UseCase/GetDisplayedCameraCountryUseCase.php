<?php


namespace App\Domain\WindyApi\UseCase;


use App\Domain\WindyApi\Service\WindyClient;

class GetDisplayedCameraCountryUseCase
{
    private WindyClient $client;

    public function __construct(WindyClient $client)
    {
        $this->client = $client;
    }

    public function get(int $randomCameraId): string
    {
        $response = $this->client->getRequest("/webcam=$randomCameraId?show=countries");
        return $response->json()['result']['countries'][0]['name'];
    }
}
