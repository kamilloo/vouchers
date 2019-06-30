<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    /**
     * @test
     */
    public function index_get_redirection_for_no_login()
    {
        $response = $this->get(route('profile.index'));

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function index_get_profile_page()
    {
        $this->user = factory(User::class)->create();
        $this->be($this->user);
        $response = $this->get(route('profile.index'));

        $response->assertStatus(200);
    }


    /**
     * @test
     */
    public function update_store_data()
    {
        $this->user = factory(User::class)->create();
        $this->be($this->user);
        $response = $this->post(route('profile.update'));

        $response->assertStatus(200);
    }
}
