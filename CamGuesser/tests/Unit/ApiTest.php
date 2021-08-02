<?php

namespace Tests\Unit;

use App\Http\Controllers\APIHandler;
use Tests\TestCase;

class ApiTest extends TestCase
{

    public function test_if_api_connection_successful(): void
    {
        $api = new APIHandler();
        self::assertTrue($api->connect());
    }

    public function test_if_api_returns_list_of_all_countries(): void
    {
        $api = new APIHandler();
        self::assertArrayHasKey('countries',$api->getAllCountries()['result']);
    }

    public function test_if_api_returns_one_random_webcam_id(): void
    {
        $api = new APIHandler();
        self::assertIsInt($api->getOneRandomCameraId());
    }

    public function test_if_api_returns_one_random_webcam_player_embed_link(): void
    {
        $api = new APIHandler();
        self::assertIsString($api->getRandomCameraPlayerEmbed());
    }
}
