<?php


namespace App\Domain\WindyApi\Dto;


class Id
{
    private int $id;

    public function __construct(int $id)
    {

        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
