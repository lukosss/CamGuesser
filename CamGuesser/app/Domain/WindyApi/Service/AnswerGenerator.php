<?php


namespace App\Domain\WindyApi\Service;

use App\Domain\WindyApi\Dto\GeneratedAnswers;
use App\Domain\WindyApi\UseCase\GetAllCountriesUseCase;

class AnswerGenerator
{
    private GetAllCountriesUseCase $useCase;

    public function __construct(GetAllCountriesUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function generate(string $country): GeneratedAnswers
    {
        $numberOfWrongAnswers = 3;
        $allCountries = $this->useCase->get();
        $answers = array_intersect_key($allCountries, array_flip(array_rand($allCountries, $numberOfWrongAnswers)));

        while (in_array($country, $answers, true)) {
            $answers = array_intersect_key($allCountries, array_flip(array_rand($allCountries, $numberOfWrongAnswers)));
        }

        $answers[] = $country;
        shuffle($answers);

        return new GeneratedAnswers($answers);
    }
}
