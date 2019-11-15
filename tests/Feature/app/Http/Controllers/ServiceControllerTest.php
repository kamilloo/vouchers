<?php

namespace Tests\Feature\App\Http\StarterTest;

use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Service;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class ServiceControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Service
     */
    private $service;
    /**
     * @var Merchant
     */
    private $merchant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createUserAndBe();
        $this->merchant = $this->user->merchant()->first();

    }

    /**
     * @test
     */
    public function index_get_categories_list()
    {
        $response = $this->get(route('services.index'))
            ->assertViewHas('services');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function create_show_view()
    {
        $response = $this->get(route('services.create'))
            ->assertViewIs('services.create');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store_validation_exception()
    {
        $redirect_url = route('services.create');
        $response = $this->call(Request::METHOD_POST, route('services.store'), [
            'title' => false,
            'description' => false,
            'active' => 'no boolean',
        ], [],[],['HTTP_REFERER' => $redirect_url]);

        $response->assertStatus(302)->assertRedirect($redirect_url);
        $response->assertSessionHasErrors([
            'title',
            'description',
            'active'
        ]);
    }

    /**
     * @test
     */
    public function store_add_service_to_db()
    {
        $incoming_data = [
            'title' => 'title',
            'description' => 'description',
            'active' => CategoryStatus::ACTIVE
        ];
        $response = $this->post(route('services.store'), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('services.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('services', [
                'merchant_id' => $this->merchant->id,
            ] + $incoming_data);
    }

    /**
     * @test
     */
    public function update_got_403_authorization_denied()
    {
        $this->service = factory(Service::class)->create();
        $response = $this->put(route('services.update', $this->service));
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function update_validation_exception()
    {
        $this->createService();
        $redirect_url = route('services.edit', $this->service);
        $response = $this->call(Request::METHOD_PUT, route('services.update', $this->service), [
            'title' => false,
            'description' => false,
            'active' => 'no boolean',
        ], [],[],['HTTP_REFERER' => $redirect_url]);

        $response->assertStatus(302)->assertRedirect($redirect_url);
        $response->assertSessionHasErrors([
            'title',
            'description',
            'active'
        ]);
    }

    /**
     * @test
     */
    public function update_service_was_updated()
    {
        $this->createService();

        $response = $this->put(route('services.update', $this->service), [
            'title' => 'title',
            'description' => 'description',
            'active' => CategoryStatus::ACTIVE
        ]);

        $response->assertStatus(302)->assertRedirect(route('services.index'))->assertSessionHas('success');
    }

    /**
     * @test
     */
    public function update_database_was_updated()
    {
        $this->createService();
        $incoming_data = [
            'title' => 'update title',
            'description' => 'update description',
            'active' => CategoryStatus::ACTIVE
        ];
        $response = $this->put(route('services.update', $this->service), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('services.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('services', [
            'merchant_id' => $this->merchant->id,
        ] + $incoming_data);
    }

    /**
     * @test
     */
    public function delete_voucher_was_removed()
    {
        $this->createService();

        $response = $this->delete(route('services.destroy', $this->service));

        $response->assertStatus(302)
            ->assertRedirect(route('services.index'))
            ->assertSessionHas('info');

        $this->assertDatabaseMissing('services', [
                'id' => $this->service->id,
            ]);
    }

    protected function createService(): void
    {
        $this->service = factory(Service::class)->create([
            'merchant_id' => $this->merchant->id,
        ]);
    }
}
