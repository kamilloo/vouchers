<?php

namespace Tests\Feature\App\Http;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StarterTest extends TestCase
{
    /**
     * @test
     */
    public function get_started_show_form()
    {
        $response = $this->get(route('get-started'));

        $response->assertStatus(200);
    }
}
