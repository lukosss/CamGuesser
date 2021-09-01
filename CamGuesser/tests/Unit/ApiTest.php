<?php

namespace Tests\Unit;

use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Http;
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

    public function test_should_return_array_of_all_available_countries(): void
    {
        Http::fake([
            'https://api.windy.com/api/webcams/v2/list?show=countries' => Http::response(
                ['result' => ['countries' => [['name'=>'Fake Switzerland','id'=>'CH'],['name'=>'Fake Germany','id'=>'DE']]]]
            )
        ]);

        self::assertContains('Fake Germany',$this->api->getAllCountries());
    }

    public function test_should_return_one_random_webcam_id(): void
    {
        Http::fake([
            'https://api.windy.com/api/webcams/v2/list/orderby=random/limit=1' => Http::response(
                ['result' => ['webcams' => [['id'=>1475827938]]]]
            )
        ]);

        self::assertSame(self::RANDOM_CAMERA_ID,$this->api->getOneRandomCameraId());
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
