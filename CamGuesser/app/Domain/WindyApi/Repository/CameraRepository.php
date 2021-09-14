<?php


namespace App\Domain\WindyApi\Repository;

use App\Domain\WindyApi\Dto\RandomlySelectedCamera;
use App\Domain\WindyApi\UseCase\GetDisplayedCameraCountryUseCase;
use App\Domain\WindyApi\UseCase\GetOneRandomCameraIdUseCase;
use App\Domain\WindyApi\UseCase\GetRandomCameraPlayerUseCase;

class CameraRepository
{

    private GetOneRandomCameraIdUseCase $randomCameraId;
    private GetRandomCameraPlayerUseCase $randomCameraPlayerEmbedLink;
    private GetDisplayedCameraCountryUseCase $displayedCameraCountry;

    public function __construct()
    {
        $this->randomCameraId = new GetOneRandomCameraIdUseCase();
        $this->randomCameraPlayerEmbedLink = new GetRandomCameraPlayerUseCase();
        $this->displayedCameraCountry = new GetDisplayedCameraCountryUseCase();
    }

    public function findRandomCamera(): RandomlySelectedCamera
    {
        $selectedCameraId = $this->randomCameraId->get();
        $url = $this->randomCameraPlayerEmbedLink->get($selectedCameraId);
        $country = $this->displayedCameraCountry->get($selectedCameraId);
        return new RandomlySelectedCamera($url, $selectedCameraId, $country);
    }

}
