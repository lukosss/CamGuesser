<?php

namespace App\Http\Controllers;

use App\Domain\Level\UseCase\GenerateLevelUseCase;
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

        return view('game', compact('generatedLevel'));
    }

}
