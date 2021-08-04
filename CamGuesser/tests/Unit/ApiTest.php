<?php

namespace Tests\Unit;

use App\Http\Controllers\APIController;
use Tests\TestCase;

class ApiTest extends TestCase
{

    public function test_if_api_connection_successful(): void
    {
        $api = new APIController();
        self::assertTrue($api->connect());
    }

    public function test_if_api_returns_list_of_all_countries(): void
    {
        $api = new APIController();
        self::assertArrayHasKey('countries',$api->getAllCountries()['result']);
    }

    public function test_if_api_returns_one_random_webcam_id(): void
    {
        $api = new APIController();
        self::assertIsInt($api->getOneRandomCameraId());
    }

    public function test_if_api_returns_one_random_webcam_player_embed_link(): void
    {
        $api = new APIController();
        self::assertIsString($api->getRandomCameraPlayerEmbed());
    }
}
