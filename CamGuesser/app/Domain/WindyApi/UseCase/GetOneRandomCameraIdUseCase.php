<?php


namespace App\Domain\WindyApi\UseCase;


use App\Domain\WindyApi\Service\WindyClient;

class GetOneRandomCameraIdUseCase extends WindyClient
{
    public function get(): int
    {
        $response = $this->getRequest('/orderby=random/limit=1');
        return $response->json()['result']['webcams'][0]['id'];
    }
}
