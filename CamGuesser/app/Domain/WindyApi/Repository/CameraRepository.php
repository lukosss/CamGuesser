<?php


namespace App\Domain\WindyApi\Repository;

use App\Domain\WindyApi\Dto\Camera;
use App\Domain\WindyApi\Service\IdClient;
use App\Domain\WindyApi\UseCase\GetRandomCameraPlayerUseCase;

class CameraRepository
{

    private IdClient $randomCameraId;
    private GetRandomCameraPlayerUseCase $randomCameraPlayer;

    public function __construct(IdClient $randomCameraId,
                                GetRandomCameraPlayerUseCase $randomCameraPlayer)
    {
        $this->randomCameraId = $randomCameraId;
        $this->randomCameraPlayer = $randomCameraPlayer;
    }

    public function findRandomCamera(): Camera
    {
        $camera = $this->randomCameraPlayer->getCamera($this->randomCameraId->getId()->getId());
        return new Camera($camera->getUrl(), $camera->getId(), $camera->getCountry());
    }

}
