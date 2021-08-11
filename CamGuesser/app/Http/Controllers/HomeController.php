<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\APIController;

class HomeController extends Controller
{

    public function index(): View
    {
        $api = new APIController();
        $randomCamId = $api->getOneRandomCameraId();
        $url = $api->getRandomCameraPlayerEmbed($randomCamId);
        $country = $api->getDisplayedCameraCountry($randomCamId);
        $allCountries = $api->getAllCountries();
        $n = 3;
        $answers = array_intersect_key( $allCountries, array_flip( array_rand( $allCountries, $n ) ) );

        while (in_array($country, $answers, true))
        {
            $answers = array_intersect_key( $allCountries, array_flip( array_rand( $allCountries, $n ) ) );
        }

        $answers[] = $country;
        shuffle($answers);

        return view('welcome',compact('url','country','answers'));
    }
}
