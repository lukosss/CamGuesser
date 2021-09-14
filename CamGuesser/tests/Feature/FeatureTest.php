<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureTest extends TestCase
{

    public function test_home_page_can_be_rendered()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_game_page_can_be_rendered()
    {
        $response = $this->get('/play');

        $response->assertStatus(200);
    }
}
