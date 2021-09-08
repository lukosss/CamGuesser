<?php


namespace App\Domain\WindyApi\Service;

use App\Domain\WindyApi\Dto\GeneratedAnswers;

class AnswerGenerator
{
    private WindyClient $windyClient;

    public function __construct()
    {
        $this->windyClient = new WindyClient();
    }

    public function generate(string $country): GeneratedAnswers
    {
        $numberOfWrongAnswers = 3;
        $allCountries = $this->windyClient->getAllCountries();
        $answers = array_intersect_key($allCountries, array_flip(array_rand($allCountries, $numberOfWrongAnswers)));

        while (in_array($country, $answers, true)) {
            $answers = array_intersect_key($allCountries, array_flip(array_rand($allCountries, $numberOfWrongAnswers)));
        }

        $answers[] = $country;
        shuffle($answers);

        return new GeneratedAnswers($answers);
    }
}
