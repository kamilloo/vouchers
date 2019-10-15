<?php

namespace Tests\Feature\App\Http\StarterTest;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function register_create_profile()
    {
        $response = $this->post(action([RegisterController::class, 'register']),[
            'name' => 'email@email.com',
            'email' => 'email@email.com',
            'password' => 'email@email.com',
            'password_confirmation' => 'email@email.com',
        ]);
        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'name' => 'email@email.com',
            'email' => 'email@email.com',
        ]);

        $user = DB::table('users')->latest()->first();

        $this->assertDatabaseHas('merchants', [
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $user->id,
        ]);
    }
}
