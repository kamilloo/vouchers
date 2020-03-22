<?php

namespace Tests\Feature\App\Http\StarterTest;

use App\Models\Branch;
use App\Models\Skill;
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
            'description' => 'some data',
            'postcode' => 'some data',
            'phone' => 'some data',
            'city' => 'some data',
            'homepage' => 'some data',
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
    public function update_add_new_branch_and_attached_user()
    {
        $this->createUserAndBe();
        $branch =  [
            'key' => 'some branch',
            'value' => 'Some Branch',
        ];
        $incoming_data = [
            'branches' => [ $branch ],
        ];
        $this->assertCount(0, Branch::all());
        $this->post(route('profile.update'), $incoming_data)
            ->assertRedirect(route('profile.index'))
            ->assertSessionHas('success');

        $this->assertCount(1, Branch::all());

        $this->assertDatabaseHas('branches', [
                'name' => $branch['value'],
                'slug' => $branch['key'],
            ]);
        $new_branch = Branch::whereRaw('1=1')->latest()->first();
        $this->assertDatabaseHas('branch_user', [
                'user_id' => $this->user->id,
                'branch_id' => $new_branch->id,
            ]);
    }


    /**
     * @test
     */
    public function update_use_existing_branch_and_attached_user()
    {
        $this->createUserAndBe();
        $branch =  [
            'key' => 'Branch',
            'value' => 'Branch',
        ];
        $incoming_data = [
            'branches' => [ $branch ],
        ];
        $existing_branch = factory(Branch::class)->create([
            'name' => 'Branch',
            'slug' => 'branch',
        ]);
        $this->post(route('profile.update'), $incoming_data)
            ->assertRedirect(route('profile.index'))
            ->assertSessionHas('success');

        $this->assertCount(1, Branch::all());

        $this->assertDatabaseHas('branches', [
            'name' => $branch['value'],
        ]);
        $this->assertDatabaseHas('branch_user', [
            'user_id' => $this->user->id,
            'branch_id' => $existing_branch->id,
        ]);
    }

    /**
     * @test
     */
    public function update_add_new_skill_and_attached_user()
    {
        $this->createUserAndBe();
        $skills = [
            'key' => 'some skills',
            'value' => 'some skills',
        ];

        $incoming_data = [
            'skills' => [ $skills ],
        ];
        $this->assertCount(0, Skill::all());
        $this->post(route('profile.update'), $incoming_data)
            ->assertRedirect(route('profile.index'))
            ->assertSessionHas('success');

        $this->assertCount(1, Skill::all());

        $this->assertDatabaseHas('skills', [
            'name' => $skills['value'],
        ]);
        $new_skill = Skill::whereRaw('1=1')->latest()->first();
        $this->assertDatabaseHas('skill_user', [
            'user_id' => $this->user->id,
            'skill_id' => $new_skill->id,
        ]);
    }

    /**
     * @test
     */
    public function update_use_existing_skill_and_attached_user()
    {
        $this->createUserAndBe();
        $skills = [
            'key' => 'Skills',
            'value' => 'Skills',
        ];

        $incoming_data = [
            'skills' => [ $skills ],
        ];
        $existing_skill = factory(Skill::class)
            ->create([
                'slug' => 'skills',
                'name' => 'skills',
            ]);
        $this->post(route('profile.update'), $incoming_data)
            ->assertRedirect(route('profile.index'))
            ->assertSessionHas('success');

        $this->assertCount(1, Skill::all());

        $this->assertDatabaseHas('skills', [
            'name' => $skills['value'],
        ]);
        $this->assertDatabaseHas('skill_user', [
            'user_id' => $this->user->id,
            'skill_id' => $existing_skill->id,
        ]);
    }


    /**
     * @test
     */
    public function update_store_social_media()
    {
        $this->createUserAndBe();
        $social_media = [
            [
                'page' => 'http://facebook.com',
                'type' => 'facebook',
            ],
        ];

        $incoming_data = [
            'social_media' => $social_media,
        ];

        $this->post(route('profile.update'), $incoming_data)
            ->assertRedirect(route('profile.index'))
            ->assertSessionHas('success');

        $profile = $this->user->profile->fresh();
        $this->assertSame($social_media, $profile->social_media);
    }

    /**
     * @test
     */
    public function update_avatar_was_stored()
    {
        $this->createUserAndBe();
        $incoming_data = [
            'avatar' => $this->file
        ];
        $this->post(route('profile.update'), $incoming_data);

        $avatar_file_name = $this->user->profile->avatar;
        Storage::assertExists($avatar_file_name);

    }
}
