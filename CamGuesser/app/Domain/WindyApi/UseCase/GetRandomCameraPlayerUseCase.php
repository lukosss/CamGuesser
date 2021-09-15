<?php


namespace App\Domain\WindyApi\UseCase;

use App\Application\Camera\CameraDenormalizer;
use App\Domain\WindyApi\Dto\Camera;
use App\Domain\WindyApi\Service\WindyClient;
use Illuminate\Http\Client\Response;

class GetRandomCameraPlayerUseCase
{
    private WindyClient $client;
    private CameraDenormalizer $denormalizer;

    public function __construct(WindyClient $client, CameraDenormalizer $denormalizer)
    {
        $this->client = $client;
        $this->denormalizer = $denormalizer;
    }

    public function get(int $randomCameraId): Camera
    {
        $response = $this->client->getRequest("/webcam=$randomCameraId?show=webcams:player,location");
        return $this->getCameraFromResponse($response);
    }

    private function getCameraFromResponse(Response $response): Camera
    {
        return $this->denormalizer->denormalize(
            $response->json()['result'],
            Camera::class
        );
    }
}
