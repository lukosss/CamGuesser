<?php

namespace App\Domain\WindyApi\UseCase;

use App\Domain\WindyApi\Dto\GeneratedQuestion;
use App\Domain\WindyApi\Service\WindyClient;

class PickRandomCameraAndGenerateAnswers
{

    private WindyClient $windyClient;

    public function __construct()
    {
        $this->windyClient = new WindyClient();
    }

    public function generate(): GeneratedQuestion
    {
        $randomCameraId = $this->windyClient->getOneRandomCameraId();
        $url = $this->windyClient->getRandomCameraPlayerEmbed($randomCameraId);
        $displayedCameraCountry = $this->windyClient->getDisplayedCameraCountry($randomCameraId);
        $allCountries = $this->windyClient->getAllCountries();
        $answers = $this->generateAnswers($allCountries, $displayedCameraCountry);

        return new GeneratedQuestion($url, $displayedCameraCountry, $answers);
    }

    private function generateAnswers(array $allCountries, string $displayedCameraCountry): array
    {
        $numberOfWrongAnswers = 3;
        $answers = array_intersect_key($allCountries, array_flip(array_rand($allCountries, $numberOfWrongAnswers)));

        while (in_array($displayedCameraCountry, $answers, true)) {
            $answers = array_intersect_key($allCountries, array_flip(array_rand($allCountries, $numberOfWrongAnswers)));
        }

        $answers[] = $displayedCameraCountry;
        shuffle($answers);
        return $answers;
    }

}
