<?php

namespace Tests\Feature\App\Http\StarterTest;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class ApiLoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;

    protected function setUp(): void
    {
        parent::setUp();
        $this->email = 'email@email.com';
        $this->password = 'password';

        factory(User::class)->create([
            'email' => $this->email,
            'password' => \Hash::make($this->password)
        ]);
    }

    /** @test */
    public function it_will_register_a_user()
    {
        $response = $this->post('api/register', [
            'email'    => 'test2@email.com',
            'password' => '123456',
            'name' => 'name',
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /** @test */
    public function it_will_log_a_user_in()
    {
        $response = $this->post('api/login', [
            'email'    => $this->email,
            'password' => $this->password
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /** @test */
    public function it_will_not_log_an_invalid_user_in()
    {
        $response = $this->post('api/login', [
            'email'    => $this->email,
            'password' => 'notlegitpassword'
        ]);

        $response->assertJsonStructure([
            'error',
        ]);
    }
}
