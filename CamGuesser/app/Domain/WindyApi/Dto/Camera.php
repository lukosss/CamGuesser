<?php


namespace App\Domain\WindyApi\Dto;


class Camera
{
    private string $url;
    private int $id;
    private string $country;

    public function __construct(string $url, int $id, string $country)
    {
        $this->url = $url;
        $this->id = $id;
        $this->country = $country;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}
