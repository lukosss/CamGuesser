<?php

namespace Tests\Unit;

use App\Http\Controllers\APIHandler;
use Tests\TestCase;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class ExampleTest extends TestCase
{

    public function test_if_api_connection_successful(): void
    {
        $api = new APIHandler();
        self::assertTrue($api->connect());
    }

    public function test_if_api_returns_list_of_all_countries(): void
    {
        $api = new APIHandler();
        self::assertArrayHasKey('result',$api->getAllCountries());
    }

}
