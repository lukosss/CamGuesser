<?php


namespace App\Domain\WindyApi\UseCase;


use App\Domain\WindyApi\Service\WindyClient;

class GetDisplayedCameraCountryUseCase extends WindyClient
{
    public function get(int $randomCameraId): string
    {
        $response = $this->getRequest("/webcam=$randomCameraId?show=countries");
        return $response->json()['result']['countries'][0]['name'];
    }
}
