<?php

namespace App\Domain\Level\UseCase;

use App\Domain\Level\Dto\GeneratedLevel;
use App\Domain\Camera\Repository\CameraRepository;
use App\Domain\Level\Repository\AnswerRepository;

class GenerateEULevelUseCase
{
    private const GET_ID_ENDPOINT = "/orderby=random/limit=1/continent=EU";

    private CameraRepository $cameraRepository;
    private AnswerRepository $answerRepository;

    public function __construct(CameraRepository $cameraRepository, AnswerRepository $answerRepository)
    {
        $this->cameraRepository = $cameraRepository;
        $this->answerRepository = $answerRepository;
    }

    public function generate(): GeneratedLevel
    {
        $camera = $this->cameraRepository->getCamera(self::GET_ID_ENDPOINT);
        $url = $camera->getUrl();
        $displayedCameraCountry = $camera->getCountry();
        $answers = $this->answerRepository->generate($displayedCameraCountry)->getAnswers();

        return new GeneratedLevel($url, $displayedCameraCountry, $answers);
    }

}
