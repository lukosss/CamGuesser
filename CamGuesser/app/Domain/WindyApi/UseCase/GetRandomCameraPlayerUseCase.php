<?php


namespace App\Domain\WindyApi\UseCase;

use App\Domain\WindyApi\Service\WindyClient;

class GetRandomCameraPlayerUseCase extends WindyClient
{

    public function get(int $randomCameraId): string
    {
        $response = $this->getRequest("/webcam=$randomCameraId?show=webcams:player");
        return $response->json()['result']['webcams'][0]['player']['day']['embed'];
    }
}
