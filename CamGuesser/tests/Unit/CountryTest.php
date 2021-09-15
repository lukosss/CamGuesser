<?php

namespace Tests\Unit;

use App\Domain\Country\Dto\CountryCollection;
use App\Domain\Country\Service\CountryClient;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /**
     * @var CountryClient|MockObject
     */
    private $CountriesClient;
    private CountryCollection $countries;
    private CountryCollection $mockCountries;


    public function setUp(): void
    {
        parent::setUp();

        $this->CountriesClient = $this->createMock(CountryClient::class);
        $this->CountriesClient->expects($this->once())->method('getCountryCollection')
            ->willReturn(new CountryCollection());

        $this->mockCountries = new CountryCollection();
        $this->countries = $this->CountriesClient->getCountryCollection();

    }

    public function test_should_return_collection_of_all_available_countries(): void
    {
        self::assertEquals($this->mockCountries, $this->countries);
    }
}
