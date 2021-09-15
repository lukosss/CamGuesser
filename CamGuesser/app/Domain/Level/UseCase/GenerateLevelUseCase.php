<?php

namespace App\Domain\Level\UseCase;

use App\Domain\Level\Dto\GeneratedLevel;
use App\Domain\Camera\Repository\CameraRepository;
use App\Domain\Level\Repository\AnswerRepository;

class GenerateLevelUseCase
{

    private CameraRepository $cameraRepository;
    private AnswerRepository $answerRepository;

    public function __construct(CameraRepository $cameraRepository, AnswerRepository $answerRepository)
    {
        $this->cameraRepository = $cameraRepository;
        $this->answerRepository = $answerRepository;
    }

    public function generate(): GeneratedLevel
    {
        $camera = $this->cameraRepository->getCamera();
        $url = $camera->getUrl();
        $displayedCameraCountry = $camera->getCountry();
        $answers = $this->answerRepository->generate($displayedCameraCountry)->getAnswers();

        return new GeneratedLevel($url, $displayedCameraCountry, $answers);
    }

}
