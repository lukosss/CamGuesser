<?php


namespace App\Domain\Level\Repository;

use App\Domain\Level\Dto\GeneratedAnswers;
use App\Domain\Country\Service\CountryClient;

class AnswerRepository
{
    private CountryClient $countryClient;

    public function __construct(CountryClient $countryClient)
    {
        $this->countryClient = $countryClient;
    }

    public function generate(string $country): GeneratedAnswers
    {
        $numberOfWrongAnswers = 3;
        $countryCollection = $this->countryClient->getCountryCollection()->getCountries();
        $mappedCountries = array_map(static function($o) { return $o->getName();}, $countryCollection);
        $answers = array_intersect_key($mappedCountries, array_flip(array_rand($mappedCountries, $numberOfWrongAnswers)));

        while (in_array($country, $answers, true)) {
            $answers = array_intersect_key($mappedCountries, array_flip(array_rand($mappedCountries, $numberOfWrongAnswers)));
        }

        $answers[] = $country;
        shuffle($answers);

        return new GeneratedAnswers($answers);
    }
}
