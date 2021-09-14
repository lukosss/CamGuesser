<?php


namespace App\Domain\WindyApi\Repository;

use App\Domain\WindyApi\Dto\Camera;
use App\Domain\WindyApi\UseCase\GetDisplayedCameraCountryUseCase;
use App\Domain\WindyApi\UseCase\GetOneRandomCameraIdUseCase;
use App\Domain\WindyApi\UseCase\GetRandomCameraPlayerUseCase;

class CameraRepository
{

    private GetOneRandomCameraIdUseCase $randomCameraId;
    private GetRandomCameraPlayerUseCase $randomCameraPlayerEmbedLink;
    private GetDisplayedCameraCountryUseCase $displayedCameraCountry;

    public function __construct(GetOneRandomCameraIdUseCase $randomCameraId,
                                GetRandomCameraPlayerUseCase $randomCameraPlayerEmbedLink,
                                GetDisplayedCameraCountryUseCase $displayedCameraCountry)
    {
        $this->randomCameraId = $randomCameraId;
        $this->randomCameraPlayerEmbedLink = $randomCameraPlayerEmbedLink;
        $this->displayedCameraCountry = $displayedCameraCountry;
    }

    public function findRandomCamera(): Camera
    {
        $selectedCameraId = $this->randomCameraId->get();
        $url = $this->randomCameraPlayerEmbedLink->get($selectedCameraId);
        $country = $this->displayedCameraCountry->get($selectedCameraId);
        return new Camera($url, $selectedCameraId, $country);
    }

}
