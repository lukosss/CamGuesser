<?php

namespace App\Http\Controllers;

use App\Domain\WindyApi\UseCase\PickRandomCameraAndGenerateAnswers;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{

    private PickRandomCameraAndGenerateAnswers $useCase;

    public function __construct()
    {
        $this->useCase = new PickRandomCameraAndGenerateAnswers();
    }

    public function index(): View
    {
        $generatedQuestion = $this->useCase->generate();
        $url = $generatedQuestion->getUrl();
        $displayedCameraCountry = $generatedQuestion->getDisplayedCameraCountry();
        $answers = $generatedQuestion->getAnswers();

        return view('welcome', compact('url', 'displayedCameraCountry', 'answers'));
    }

}
