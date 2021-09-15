<?php


namespace App\Domain\WindyApi\Service;

use App\Domain\WindyApi\Dto\GeneratedAnswers;

class AnswerGenerator
{
    private CountriesClient $useCase;

    public function __construct(CountriesClient $useCase)
    {
        $this->useCase = $useCase;
    }

    public function generate(string $country): GeneratedAnswers
    {
        $numberOfWrongAnswers = 3;
        $countryCollection = $this->useCase->getCountries()->getCountries();
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
