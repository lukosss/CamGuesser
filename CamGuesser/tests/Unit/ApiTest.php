<?php

namespace Tests\Unit;

use App\Http\Controllers\APIController;
use Tests\TestCase;

class ApiTest extends TestCase
{

    private const RANDOM_CAMERA_ID = 1475827938;

    private APIController $api;

    public function setUp(): void
    {
        parent::setUp();
        $this->api = new APIController();
    }

    public function test_if_api_connection_successful(): void
    {
        self::assertTrue($this->api->connect());
    }

    public function test_if_api_returns_list_of_all_countries(): void
    {
        self::assertIsArray($this->api->getAllCountries());
    }

    public function test_if_api_returns_one_random_webcam_id(): void
    {
        self::assertIsInt($this->api->getOneRandomCameraId());
    }

    public function test_if_api_returns_one_random_webcam_player_embed_link(): void
    {
        self::assertIsString($this->api->getRandomCameraPlayerEmbed(self::RANDOM_CAMERA_ID));
    }

    public function test_if_api_returns_displayed_cameras_country(): void
    {
        self::assertContains($this->api->getDisplayedCameraCountry(self::RANDOM_CAMERA_ID),$this->api->getAllCountries());
    }
}
