<?php


namespace App\Domain\WindyApi\Service;


use App\Domain\WindyApi\Dto\RandomlySelectedCamera;

class CameraRepository
{

    private WindyClient $windyClient;

    public function __construct()
    {
        $this->windyClient = new WindyClient();
    }

    public function findRandomCamera(): RandomlySelectedCamera
    {
        $randomCameraId = $this->windyClient->getOneRandomCameraId();
        $url = $this->windyClient->getRandomCameraPlayerEmbed($randomCameraId);
        $country = $this->windyClient->getDisplayedCameraCountry($randomCameraId);
        return new RandomlySelectedCamera($url, $randomCameraId, $country);
    }

}
