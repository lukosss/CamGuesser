<?php


namespace App\Domain\Level\Dto;


class GeneratedAnswers
{
    private array $answers;

    public function __construct(array $answers)
    {
        $this->answers = $answers;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }
}
