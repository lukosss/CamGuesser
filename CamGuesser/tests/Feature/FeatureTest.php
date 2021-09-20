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

    public function test_classic_game_page_can_be_rendered()
    {
        $response = $this->get('/classic-mode');

        $response->assertStatus(200);
    }

    public function test_europe_game_page_can_be_rendered()
    {
        $response = $this->get('/europe-mode');

        $response->assertStatus(200);
    }
}
