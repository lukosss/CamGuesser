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
        return view('welcome',compact('url','country'));
    }
}
