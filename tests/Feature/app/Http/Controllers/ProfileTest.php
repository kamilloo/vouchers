<?php

namespace Tests\Feature\App\Http\StarterTest;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var UploadedFile
     */
    private $file;
    /**
     * @var \Illuminate\Http\Testing\FileFactory
     */
    private $file_factory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->file_factory = UploadedFile::fake();
        $this->file = $this->file_factory->image('png');

    }

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
        $this->createUserAndBe();
        $response = $this->get(route('profile.index'));

        $response->assertStatus(200);
    }
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
    public function update_user_not_change_data()
    {
        $this->user = factory(User::class)->create();
        $this->be($this->user);
        $response = $this->post(route('profile.update'));

        $response->assertStatus(302)->assertRedirect(route('profile.index'))->assertSessionHas('success');
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
            'description' => 'some data',
            'branch' => 'some data',
        ];
        $this->post(route('profile.update'), $incoming_data)
            ->assertRedirect(route('profile.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $this->user->id,
        ] + $incoming_data);
    }

    /**
     * @test
     */
    public function update_logo_was_stored()
    {
        $this->createUserAndBe();
        $incoming_data = [
            'logo' => $this->file
        ];
        $this->post(route('profile.update'), $incoming_data);

        $logo_file_name = $this->user->profile->logo;
        Storage::assertExists($logo_file_name);

    }
}
