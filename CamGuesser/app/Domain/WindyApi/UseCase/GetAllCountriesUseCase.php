<?php


namespace App\Domain\WindyApi\UseCase;


use App\Domain\WindyApi\Service\WindyClient;

class GetAllCountriesUseCase
{
    private WindyClient $client;

    public function __construct(WindyClient $client)
    {
        $this->client = $client;
    }

    public function get(): array
    {
        $response = $this->client->getRequest('?show=countries');
        $countries = $response->json()['result']['countries'];
        $filteredCountries = [];
        foreach ($countries as $country) {
            $filteredCountries[] = $country['name'];
        }
        return $filteredCountries;
    }

}
