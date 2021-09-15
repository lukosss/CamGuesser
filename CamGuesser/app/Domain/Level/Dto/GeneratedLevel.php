<?php


namespace App\Domain\Level\Dto;


class GeneratedLevel
{

    private string $url;
    private string $displayedCameraCountry;
    private array $answers;

    public function __construct(string $url, string $displayedCameraCountry, array $answers)
    {
        $this->url = $url;
        $this->displayedCameraCountry = $displayedCameraCountry;
        $this->answers = $answers;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getDisplayedCameraCountry(): string
    {
        return $this->displayedCameraCountry;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }
}

