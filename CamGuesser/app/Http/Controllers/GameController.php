<?php

namespace App\Http\Controllers;

use App\Domain\WindyApi\UseCase\GenerateLevelUseCase;
use Illuminate\Contracts\View\View;

class GameController extends Controller
{

    private GenerateLevelUseCase $useCase;

    public function __construct(GenerateLevelUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function index(): View
    {
        $generatedLevel = $this->useCase->generate();
        $url = $generatedLevel->getUrl();
        $displayedCameraCountry = $generatedLevel->getDisplayedCameraCountry();
        $answers = $generatedLevel->getAnswers();

        return view('game', compact('url', 'displayedCameraCountry', 'answers'));
    }

}
