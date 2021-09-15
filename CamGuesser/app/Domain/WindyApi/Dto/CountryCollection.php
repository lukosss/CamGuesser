<?php


namespace App\Domain\WindyApi\Dto;


class CountryCollection
{
    private array $countries;

    public function __construct(Country... $countries)
    {
        $this->countries = $countries;
    }

    public function getCountries(): array
    {
        return $this->countries;
    }
}
