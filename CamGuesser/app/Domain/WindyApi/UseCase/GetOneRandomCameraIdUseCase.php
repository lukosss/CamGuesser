<?php


namespace App\Domain\WindyApi\UseCase;

use App\Domain\WindyApi\Service\WindyClient;

class GetOneRandomCameraIdUseCase
{
    private WindyClient $client;

    public function __construct(WindyClient $client)
    {
        $this->client = $client;
    }

    public function get(): int
    {
        $response = $this->client->getRequest('/orderby=random/limit=1');
        return $response->json()['result']['webcams'][0]['id'];
    }
}
