<?php


namespace App\Domain\Country\Service;


use App\Application\Country\Serializer\Denormalizer\CountryCollectionDenormalizer;
use App\Domain\Country\Dto\CountryCollection;
use App\Infrastructure\Http\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

class CountryClient
{
    private const BASE_URL = 'https://api.windy.com/api/webcams/v2/list';
    private const GET_COUNTRIES_ENDPOINT = "?show=countries";

    private CountryCollectionDenormalizer $denormalizer;
    private HttpClient $http;
    private string $apiKey;

    public function __construct(HttpClient $http, CountryCollectionDenormalizer $denormalizer, string $apiKey)
    {
        $this->denormalizer = $denormalizer;
        $this->http = $http;
        $this->apiKey = $apiKey;
    }

    public function getCountryCollection(): CountryCollection
    {
        $response = $this->makeRequest();
        return $this->getCountriesFromResponse($response);
    }

    private function makeRequest(): ResponseInterface
    {
        $options = ['headers' => ['x-windy-key' => $this->apiKey]];
        return $this->http->get(self::BASE_URL, self::GET_COUNTRIES_ENDPOINT, $options);
    }

    private function getCountriesFromResponse(ResponseInterface $response): CountryCollection
    {
        return $this->denormalizer->denormalize(
            json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR),
            CountryCollection::class
        );
    }
}
