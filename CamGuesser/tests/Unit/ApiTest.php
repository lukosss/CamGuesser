<?php

namespace Tests\Unit;

use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ApiTest extends TestCase
{

    private const FAKE_RANDOM_CAMERA_ID = 1234567890;
    private const REQUEST_URL = 'https://api.windy.com/api/webcams/v2/list*';

    private APIController $api;

    public function setUp(): void
    {
        parent::setUp();
        $this->api = new APIController();
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

        self::assertContains('Fake Germany', $this->api->getAllCountries());
    }

    public function test_should_return_one_random_webcam_id(): void
    {
        Http::fake([
            self::REQUEST_URL => Http::response(
                ['result' => ['webcams' => [['id' => self::FAKE_RANDOM_CAMERA_ID]]]]
            )
        ]);

        self::assertSame(self::FAKE_RANDOM_CAMERA_ID, $this->api->getOneRandomCameraId());
    }

    public function test_should_return_one_random_webcam_player_embed_link(): void
    {
        Http::fake([
            self::REQUEST_URL => Http::response(
                ['result' => ['webcams' => [['player' => ['day' => [
                    'embed' => 'https://webcams.windy.com/webcams/public/embed/player/1234567890/FAKELINK'
                ]]]]]]
            )
        ]);

        self::assertSame(
            'https://webcams.windy.com/webcams/public/embed/player/1234567890/FAKELINK',
            $this->api->getRandomCameraPlayerEmbed(self::FAKE_RANDOM_CAMERA_ID)
        );
    }

    public function test_should_return_displayed_cameras_country(): void
    {
        Http::fake([
            self::REQUEST_URL => Http::response(
                ['result' => ['countries' => [['name' => 'Fake Lithuania']]]]
            )
        ]);

        self::assertSame('Fake Lithuania', $this->api->getDisplayedCameraCountry(self::FAKE_RANDOM_CAMERA_ID));
    }
}
