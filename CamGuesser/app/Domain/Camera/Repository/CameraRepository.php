<?php


namespace App\Domain\Camera\Repository;

use App\Domain\Camera\Dto\Camera;
use App\Domain\Id\Service\IdClient;
use App\Domain\Camera\Service\CameraClient;

class CameraRepository
{

    private IdClient $id;
    private CameraClient $camera;

    public function __construct(IdClient $id,
                                CameraClient $camera)
    {
        $this->id = $id;
        $this->camera = $camera;
    }

    public function getCamera(string $endpoint): Camera
    {
        $camera = $this->camera->getCamera($this->id->getId($endpoint)->getId());
        return new Camera($camera->getUrl(), $camera->getId(), $camera->getCountry());
    }

}
