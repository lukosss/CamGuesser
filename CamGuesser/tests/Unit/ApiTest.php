<?php

namespace Tests\Unit;

use App\Application\Camera\CameraDenormalizer;
use App\Domain\WindyApi\Service\WindyClient;
use App\Domain\WindyApi\UseCase\GetAllCountriesUseCase;
use App\Domain\WindyApi\UseCase\GetOneRandomCameraIdUseCase;
use App\Domain\WindyApi\UseCase\GetRandomCameraPlayerUseCase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ApiTest extends TestCase
{

    private const FAKE_RANDOM_CAMERA_ID = 1234567890;
    private const REQUEST_URL = 'https://api.windy.com/api/webcams/v2/list*';

    private GetAllCountriesUseCase $allCountries;
    private GetOneRandomCameraIdUseCase $randomCameraId;
    private GetRandomCameraPlayerUseCase $randomCameraPlayer;

    public function setUp(): void
    {
        parent::setUp();
        $windyClient = new WindyClient();
        $denormalizer = new CameraDenormalizer();
        $this->allCountries = new GetAllCountriesUseCase($windyClient);
        $this->randomCameraId = new GetOneRandomCameraIdUseCase($windyClient);
        $this->randomCameraPlayer = new GetRandomCameraPlayerUseCase($windyClient, $denormalizer);
    }

    public function test_should_return_array_of_all_available_countries(): void
    {
        Http::fake([
            self::REQUEST_URL => Http::response(
                ['result' => ['countries' => [
                    ['name' => 'Fake Switzerland', 'id' => 'CH'], ['name' => 'Fake Germany', 'id' => 'DE']
                ]]]
            )
        ]);

        self::assertContains('Fake Germany', $this->allCountries->get());
    }

    public function test_should_return_one_random_webcam_id(): void
    {
        Http::fake([
            self::REQUEST_URL => Http::response(
                ['result' => ['webcams' => [['id' => self::FAKE_RANDOM_CAMERA_ID]]]]
            )
        ]);

        self::assertSame(self::FAKE_RANDOM_CAMERA_ID, $this->randomCameraId->get());
    }

    public function test_should_return_one_random_webcam_player_embed_link(): void
    {
        Http::fake([
            self::REQUEST_URL => Http::response(
                ['result' => ['webcams' => [['id' => 1234567890, 'location' => ['country' => 'China'],'player' => ['day' => [
                    'embed' => 'https://webcams.windy.com/webcams/public/embed/player/1234567890/FAKELINK'
                ]]]]]]
            )
        ]);

        self::assertSame(
            'https://webcams.windy.com/webcams/public/embed/player/1234567890/FAKELINK',
            $this->randomCameraPlayer->get(self::FAKE_RANDOM_CAMERA_ID)->getUrl()
        );
    }

    public function test_should_return_displayed_cameras_country(): void
    {
        Http::fake([
            self::REQUEST_URL => Http::response(
                ['result' => ['webcams' => [['id' => 1234567890, 'location' => ['country' => 'FAKE China'],'player' => ['day' => [
                    'embed' => 'https://webcams.windy.com/webcams/public/embed/player/1234567890/FAKELINK'
                ]]]]]]
            )
        ]);

        self::assertSame(
            'FAKE China',
            $this->randomCameraPlayer->get(self::FAKE_RANDOM_CAMERA_ID)->getCountry()
        );
    }
}
