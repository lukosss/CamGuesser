<?php


namespace App\Domain\Camera\Service;

use App\Application\Camera\Serializer\Denormalizer\CameraDenormalizer;
use App\Domain\Camera\Dto\Camera;
use App\Infrastructure\Http\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

class CameraClient
{

    private const BASE_URL = 'https://api.windy.com/api/webcams/v2/list';

    private CameraDenormalizer $denormalizer;
    private HttpClient $http;
    private string $apiKey;

    public function __construct(HttpClient $http, CameraDenormalizer $denormalizer, string $apiKey)
    {
        $this->denormalizer = $denormalizer;
        $this->http = $http;
        $this->apiKey = $apiKey;
    }

    public function getCamera(int $id): Camera
    {
        $response = $this->makeRequest($id);
        return $this->getCameraFromResponse($response);
    }

    private function makeRequest(int $id): ResponseInterface
    {
        $endpoint = "/webcam=$id?show=webcams:player,location";
        $options = ['headers' => ['x-windy-key' => $this->apiKey]];
        return $this->http->get(self::BASE_URL, $endpoint, $options);
    }

    private function getCameraFromResponse(ResponseInterface $response): Camera
    {
        return $this->denormalizer->denormalize(
            json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR),
            Camera::class
        );
    }
}
