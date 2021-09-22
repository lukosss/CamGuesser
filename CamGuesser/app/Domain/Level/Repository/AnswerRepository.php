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
        $answers = $this->collectAnswers($numberOfWrongAnswers, $country);
        $answers[] = $country;
        shuffle($answers);

        return new GeneratedAnswers($answers);
    }

    private function checkIfAnswersHaveDuplicatesAndReplace(string $country, array $answers, array $mappedCountries, int $numberOfWrongAnswers): array
    {
        while (in_array($country, $answers, true)) {
            $answers = $this->pickRandomAnswers($mappedCountries, $numberOfWrongAnswers);
        }
        return $answers;
    }

    private function pickRandomAnswers(array $countryArray, int $numberOfWrongAnswers): array
    {
        return array_intersect_key($countryArray, array_flip(array_rand($countryArray, $numberOfWrongAnswers)));
    }

    private function mapCollectionToArray(array $countryCollection): array
    {
        return array_map(static function ($country) {
            return $country->getName();
        }, $countryCollection);
    }

    private function collectAnswers(int $numberOfWrongAnswers, string $correctCountry): array
    {
        $countryCollection = $this->countryClient->getCountryCollection()->getCountries();
        $mappedCountries = $this->mapCollectionToArray($countryCollection);
        $answers = $this->pickRandomAnswers($mappedCountries, $numberOfWrongAnswers);
        $answers = $this->checkIfAnswersHaveDuplicatesAndReplace($correctCountry, $answers, $mappedCountries, $numberOfWrongAnswers);
        return $answers;
    }
}
