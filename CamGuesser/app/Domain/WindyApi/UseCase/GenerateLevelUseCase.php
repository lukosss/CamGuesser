<?php

namespace App\Domain\WindyApi\UseCase;

use App\Domain\WindyApi\Dto\GeneratedQuestion;
use App\Domain\WindyApi\Service\AnswerGenerator;
use App\Domain\WindyApi\Service\CameraRepository;

class GenerateLevelUseCase
{

    private CameraRepository $cameraRepository;
    private AnswerGenerator $answerGenerator;

    public function __construct()
    {
        $this->cameraRepository = new CameraRepository();
        $this->answerGenerator = new AnswerGenerator();
    }

    public function generate(): GeneratedQuestion
    {
        $randomCamera = $this->cameraRepository->findRandomCamera();
        $url = $randomCamera->getUrl();
        $displayedCameraCountry = $randomCamera->getCountry();
        $answers = $this->answerGenerator->generate($displayedCameraCountry)->getAnswers();

        return new GeneratedQuestion($url, $displayedCameraCountry, $answers);
    }

}
