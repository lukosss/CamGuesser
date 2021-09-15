<?php


namespace App\Infrastructure\Http;

use Psr\Http\Message\ResponseInterface;

class Client
{

    private \GuzzleHttp\Client $http;

    public function __construct(\GuzzleHttp\Client $http)
    {
        $this->http = $http;
    }

    public function get(string $baseUri, string $endpoint, array $headers): ResponseInterface
    {
        return $this->http->request('GET', $baseUri . $endpoint, $headers);
    }
}
