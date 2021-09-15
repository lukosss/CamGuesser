<?php


namespace App\Domain\WindyApi\Repository;

use App\Domain\WindyApi\Dto\Camera;
use App\Domain\WindyApi\UseCase\GetDisplayedCameraCountryUseCase;
use App\Domain\WindyApi\UseCase\GetOneRandomCameraIdUseCase;
use App\Domain\WindyApi\UseCase\GetRandomCameraPlayerUseCase;

class CameraRepository
{

    private GetOneRandomCameraIdUseCase $randomCameraId;
    private GetRandomCameraPlayerUseCase $randomCameraPlayer;

    public function __construct(GetOneRandomCameraIdUseCase $randomCameraId,
                                GetRandomCameraPlayerUseCase $randomCameraPlayer)
    {
        $this->randomCameraId = $randomCameraId;
        $this->randomCameraPlayer = $randomCameraPlayer;
    }

    public function findRandomCamera(): Camera
    {
        $camera = $this->randomCameraPlayer->get($this->randomCameraId->get());
        return new Camera($camera->getUrl(), $camera->getId(), $camera->getCountry());
    }

}
