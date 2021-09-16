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
    private $CountriesClientMock;
    private CountryCollection $countriesFromMockClient;
    private CountryCollection $countryCollection;


    public function setUp(): void
    {
        parent::setUp();

        $this->CountriesClientMock = $this->createMock(CountryClient::class);
        $this->countryCollection = new CountryCollection();
    }

    public function test_should_return_collection_of_all_available_countries(): void
    {
        $this->CountriesClientMock->expects($this->once())->method('getCountryCollection')
            ->willReturn(new CountryCollection());

        $this->countriesFromMockClient = $this->CountriesClientMock->getCountryCollection();

        self::assertEquals($this->countryCollection, $this->countriesFromMockClient);
    }
}
