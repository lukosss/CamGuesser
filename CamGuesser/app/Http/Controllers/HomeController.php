<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{

    public function index(): View
    {
        $api = new APIController();
        $randomCamId = $api->getOneRandomCameraId();
        $url = $api->getRandomCameraPlayerEmbed($randomCamId);
        $displayedCameraCountry = $api->getDisplayedCameraCountry($randomCamId);
        $allCountries = $api->getAllCountries();

        $answers = $this->generateAnswers($allCountries, $displayedCameraCountry);

        return view('welcome', compact('url', 'displayedCameraCountry', 'answers'));
    }

    /**
     * @param array $allCountries
     * @param string $displayedCameraCountry
     * @return array
     */
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
