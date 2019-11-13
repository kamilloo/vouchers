<?php

namespace Tests\Feature\App\Http\StarterTest;

use App\Models\Enums\CategoryStatus;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class ServiceCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var ServiceCategory
     */
    private $service_category;
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
        $response = $this->get(route('service-categories.index'))
            ->assertViewHas('service_categories');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function create_show_view()
    {
        $response = $this->get(route('service-categories.create'))
            ->assertViewIs('service-categories.create');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store_validation_exception()
    {
        $redirect_url = route('service-categories.create');
        $response = $this->call(Request::METHOD_POST, route('service-categories.store'), [
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
    public function store_add_service_category_to_db()
    {
        $incoming_data = [
            'title' => 'title',
            'description' => 'description',
            'active' => CategoryStatus::ACTIVE
        ];
        $response = $this->post(route('service-categories.store'), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('service-categories.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('service_categories', [
                'merchant_id' => $this->merchant->id,
            ] + $incoming_data);
    }

    /**
     * @test
     */
    public function update_got_403_authorization_denied()
    {
        $this->service_category = factory(ServiceCategory::class)->create();
        $response = $this->put(route('service-categories.update', $this->service_category));
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function update_validation_exception()
    {
        $this->createServiceCategory();
        $redirect_url = route('service-categories.edit', $this->service_category);
        $response = $this->call(Request::METHOD_PUT, route('service-categories.update', $this->service_category), [
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
    public function update_service_category_was_updated()
    {
        $this->createServiceCategory();

        $response = $this->put(route('service-categories.update', $this->service_category), [
            'title' => 'title',
            'description' => 'description',
            'active' => CategoryStatus::ACTIVE
        ]);

        $response->assertStatus(302)->assertRedirect(route('service-categories.index'))->assertSessionHas('success');
    }

    /**
     * @test
     */
    public function update_database_was_updated()
    {
        $this->createServiceCategory();
        $incoming_data = [
            'title' => 'update title',
            'description' => 'update description',
            'active' => CategoryStatus::ACTIVE
        ];
        $response = $this->put(route('service-categories.update', $this->service_category), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('service-categories.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('service_categories', [
            'merchant_id' => $this->merchant->id,
        ] + $incoming_data);
    }

    /**
     * @test
     */
    public function delete_voucher_was_removed()
    {
        $this->createServiceCategory();

        $response = $this->delete(route('service-categories.destroy', $this->service_category));

        $response->assertStatus(302)
            ->assertRedirect(route('service-categories.index'))
            ->assertSessionHas('info');

        $this->assertDatabaseMissing('service_categories', [
                'id' => $this->service_category->id,
            ]);
    }

    protected function createServiceCategory(): void
    {
        $this->service_category = factory(ServiceCategory::class)->create([
            'merchant_id' => $this->merchant->id,
        ]);
    }
}
