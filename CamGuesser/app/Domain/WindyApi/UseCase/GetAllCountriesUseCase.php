<?php


namespace App\Domain\WindyApi\UseCase;


use App\Domain\WindyApi\Service\WindyClient;

class GetAllCountriesUseCase extends WindyClient
{

    public function get(): array
    {
        $response = $this->getRequest('?show=countries');
        $countries = $response->json()['result']['countries'];
        $filteredCountries = [];
        foreach ($countries as $country) {
            $filteredCountries[] = $country['name'];
        }
        return $filteredCountries;
    }

}
