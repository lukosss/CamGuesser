<?php

namespace App\Http\Controllers;

use App\Domain\Level\UseCase\GenerateEULevelUseCase;
use Illuminate\Contracts\View\View;

class EUGameController extends Controller
{

    private GenerateEULevelUseCase $useCase;

    public function __construct(GenerateEULevelUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function index(): View
    {
        $generatedLevel = $this->useCase->generate();

        return view('game', compact('generatedLevel'));
    }

}
