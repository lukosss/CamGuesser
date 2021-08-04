<?php

namespace Tests\Unit;

use App\Http\Controllers\APIController;
use Tests\TestCase;

class ApiTest extends TestCase
{

    private int $randomCamId = 1475827938;

    public function test_if_api_connection_successful(): void
    {
        $api = new APIController();
        self::assertTrue($api->connect());
    }

    public function test_if_api_returns_list_of_all_countries(): void
    {
        $api = new APIController();
        self::assertIsArray($api->getAllCountries());
    }

    public function test_if_api_returns_one_random_webcam_id(): void
    {
        $api = new APIController();
        self::assertIsInt($api->getOneRandomCameraId());
    }

    public function test_if_api_returns_one_random_webcam_player_embed_link(): void
    {
        $api = new APIController();
        self::assertIsString($api->getRandomCameraPlayerEmbed($this->randomCamId));
    }

    public function test_if_api_returns_displayed_cameras_country(): void
    {
        $api = new APIController();
        self::assertContains($api->getDisplayedCameraCountry($this->randomCamId),$api->getAllCountries());
    }
}
