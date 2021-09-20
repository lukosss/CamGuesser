<?php

namespace App\Domain\Id\Service;

use App\Application\Id\Serializer\Denormalizer\IdDenormalizer;
use App\Domain\Id\Dto\Id;
use App\Infrastructure\Http\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;


class IdClient
{

    private const BASE_URL = 'https://api.windy.com/api/webcams/v2/list';

    private IdDenormalizer $denormalizer;
    private HttpClient $http;
    private string $apiKey;

    public function __construct(HttpClient $http, IdDenormalizer $denormalizer, string $apiKey)
    {
        $this->denormalizer = $denormalizer;
        $this->http = $http;
        $this->apiKey = $apiKey;
    }

    public function getId(string $endpoint): Id
    {
        $response = $this->makeRequest($endpoint);
        return $this->getIdFromResponse($response);
    }

    private function makeRequest(string $endpoint): ResponseInterface
    {
        $options = ['headers' => ['x-windy-key' => $this->apiKey]];
        return $this->http->get(self::BASE_URL, $endpoint, $options);
    }

    private function getIdFromResponse(ResponseInterface $response): Id
    {
        return $this->denormalizer->denormalize(
            json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR),
            Id::class
        );
    }

}
