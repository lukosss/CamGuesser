<?php

namespace Tests\Unit;

use App\Http\Controllers\APIHandler;
use Tests\TestCase;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_if_api_connection_successful()
    {
        $api = new APIHandler();
        self::assertTrue($api->connect());
    }


}
