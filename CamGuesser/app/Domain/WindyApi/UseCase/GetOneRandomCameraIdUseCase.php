<?php


namespace App\Domain\WindyApi\UseCase;

use App\Application\Camera\IdDenormalizer;
use App\Domain\WindyApi\Dto\Id;
use App\Infrastructure\Http\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

class GetOneRandomCameraIdUseCase
{
    private const BASE_URL = 'https://api.windy.com/api/webcams/v2/list';
    private const GET_ID_ENDPOINT = "/orderby=random/limit=1";

    private IdDenormalizer $denormalizer;
    private HttpClient $http;
    private string $apiKey;

    public function __construct(HttpClient $http, IdDenormalizer $denormalizer, string $apiKey)
    {
        $this->denormalizer = $denormalizer;
        $this->http = $http;
        $this->apiKey = $apiKey;
    }

    public function getId(): Id
    {
        $response = $this->makeRequest();
        return $this->getIdFromResponse($response);
    }

    private function makeRequest(): ResponseInterface
    {
        $options = ['headers' => ['x-windy-key' => $this->apiKey]];
        return $this->http->get(self::BASE_URL, self::GET_ID_ENDPOINT, $options);
    }

    private function getIdFromResponse(ResponseInterface $response): Id
    {
        return $this->denormalizer->denormalize(
            json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR),
            Id::class
        );
    }
}
