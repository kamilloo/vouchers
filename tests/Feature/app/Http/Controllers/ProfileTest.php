<?php

namespace Tests\Feature\App\Http\StarterTest;

use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function update_redirect_unauthenticated_user()
    {
        $response = $this->post(route('profile.update'));

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function update_incoming_data()
    {
        $this->createUserAndBe();
        $response = $this->call(Request::METHOD_POST, route('profile.update'), [
            'address' => false
        ], [],[],['HTTP_REFERER' => route('profile.update')]);

        $response->assertStatus(302)->assertRedirect(route('profile.edit'));
    }

    /**
     * @test
     */
    public function update_database_was_updated()
    {
        $this->createUserAndBe();
        $incoming_data = [
            'address' => 'some data',
            'company_name' => 'some data',
            'first_name' => 'some data',
            'last_name' => 'some data',
            'services' => 'some data',
            'avatar' => 'some data',
            'logo' => 'some data',
            'description' => 'some data',
            'branch' => 'some data',
        ];
        $response = $this->post(route('profile.update'), $incoming_data);

        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $this->user->id,
        ] + $incoming_data);
    }

    /**
     * @test
     */
    public function update_redirect_to_index()
    {
        $this->createUserAndBe();
        $response = $this->post(route('profile.update'));

        $response->assertStatus(302)->assertRedirect(route('profile.index'));
    }
}
