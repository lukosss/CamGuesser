<?php

namespace App\Http\Controllers;


use App\Domain\WindyApi\UseCase\GenerateLevelUseCase;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{


    private GenerateLevelUseCase $useCase;

    public function __construct()
    {
        $this->useCase = new GenerateLevelUseCase();
    }

    public function index(): View
    {
        $generatedLevel = $this->useCase->generate();
        $url = $generatedLevel->getUrl();
        $displayedCameraCountry = $generatedLevel->getDisplayedCameraCountry();
        $answers = $generatedLevel->getAnswers();

        return view('welcome', compact('url', 'displayedCameraCountry', 'answers'));
//solving conflicts
    public function index(): View
    {
        return view('welcome');
    }

}
