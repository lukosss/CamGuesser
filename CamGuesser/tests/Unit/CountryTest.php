<?php

namespace Tests\Unit;

use App\Domain\WindyApi\Dto\Country;
use App\Domain\WindyApi\Dto\CountryCollection;
use App\Domain\WindyApi\Dto\Id;
use App\Domain\WindyApi\Service\CountriesClient;
use App\Domain\WindyApi\Service\IdClient;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class CountryTest extends TestCase
{

    private const FAKE_RANDOM_CAMERA_ID = 1234567890;

    /**
     * @var CountriesClient|MockObject
     */
    private $CountriesClient;
    private CountryCollection $countries;
    private CountryCollection $mockCountries;


    public function setUp(): void
    {
        parent::setUp();

        $this->CountriesClient = $this->createMock(CountriesClient::class);
        $this->CountriesClient->expects($this->once())->method('getCountries')
            ->willReturn(new CountryCollection());

        $this->mockCountries = new CountryCollection();
        $this->countries = $this->CountriesClient->getCountries();

    }

    public function test_should_return_collection_of_all_available_countries(): void
    {
        self::assertEquals($this->mockCountries, $this->countries);
    }
}
