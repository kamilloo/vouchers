<?php

namespace Tests\Feature\App\Http;

use App\Models\Enums\CategoryStatus;
use App\Models\Enums\ServiceStatus;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServicePackage;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class ServicePackageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var ServicePackage
     */
    private $service_package;
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
        $response = $this->get(route('service-packages.index'))
            ->assertViewHas('service_packages');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function create_show_view()
    {
        $response = $this->get(route('service-packages.create'))
            ->assertViewIs('service-packages.create');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store_validation_exception()
    {
        $category = factory(ServiceCategory::class)->create();
        $service = factory(Service::class)->create();
        $redirect_url = route('service-packages.create');
        $response = $this->call(Request::METHOD_POST, route('service-packages.store'), [
            'title' => false,
            'description' => false,
            'active' => 'no boolean',
            'price' => 'no valud price',
            'category_id' => $category->id,
            'category_title' => false,
            'services' => [$service->id],
        ], [],[],['HTTP_REFERER' => $redirect_url]);

        $response->assertStatus(302)->assertRedirect($redirect_url);
        $response->assertSessionHasErrors([
            'title',
            'description',
            'active',
            'price',
            'category_id',
            'category_title',
            'services.0',
        ]);
    }

    /**
     * @test
     */
    public function store_add_service_to_db()
    {
        $incoming_data = $this->getIncomingParameters();
        $response = $this->post(route('service-packages.store'), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('service-packages.index'))
            ->assertSessionHas('success');

        unset($incoming_data['services']);
        $this->assertDatabaseHas('service_packages', [
                'merchant_id' => $this->merchant->id,
            ] + $incoming_data);
    }

    /**
     * @test
     */
    public function store_service_was_add_to_existing_category()
    {
        $service_category = factory(ServiceCategory::class)->make();
        $this->merchant->services()->save($service_category);
        $incoming_data = $this->getIncomingParameters();

        $incoming_data['category_id'] = $service_category->id;

        $response = $this->post(route('service-packages.store'), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('service-packages.index'))
            ->assertSessionHas('success');

        $service_package = ServicePackage::toMe()->latest()->first();

        $this->assertDatabaseHas('category_package', [
                'category_id' => $service_category->id,
                'package_id' => $service_package->id,
            ]);
    }

    /**
     * @test
     */
    public function store_service_was_add_to_new_category()
    {
        $incoming_data = $this->getIncomingParameters();

        $incoming_data['category_title'] = 'new_category';

        $response = $this->post(route('service-packages.store'), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('service-packages.index'))
            ->assertSessionHas('success');

        $service = ServicePackage::toMe()->latest()->first();

        $service_category = ServiceCategory::toMe()->latest()->first();

        $this->assertDatabaseHas('service_categories', [
            'title' => 'new_category',
            'description' => null,
            'active' => CategoryStatus::ACTIVE,
        ]);

        $this->assertDatabaseHas('category_package', [
            'category_id' => $service_category->id,
            'package_id' => $service->id,
        ]);
    }

    /**
     * @test
     */
    public function update_got_403_authorization_denied()
    {
        $this->service_package = factory(ServicePackage::class)->create();
        $response = $this->put(route('service-packages.update', $this->service_package));
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function update_validation_exception()
    {
        $this->createService();
        $service_category = factory(ServiceCategory::class)->create();
        $redirect_url = route('services.edit', $this->service_package);
        $response = $this->call(Request::METHOD_PUT, route('services.update', $this->service_package), [
            'title' => false,
            'description' => false,
            'active' => 'no boolean',
            'price' => 'no valud price',
            'category_id' => $service_category->id,
            'category_title' => false,
        ], [],[],['HTTP_REFERER' => $redirect_url]);

        $response->assertStatus(302)->assertRedirect($redirect_url);
        $response->assertSessionHasErrors([
            'title',
            'description',
            'active',
            'price',
            'category_id',
            'category_title',
        ]);
    }

    /**
     * @test
     */
    public function update_service_was_updated()
    {
        $this->createService();

        $response = $this->put(route('services.update', $this->service_package), [
            'title' => 'title',
            'description' => 'description',
            'active' => CategoryStatus::ACTIVE,
            'price' => 100.20
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
            'active' => ServiceStatus::ACTIVE,
            'price' => 100.20
        ];
        $response = $this->put(route('services.update', $this->service_package), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('services.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('services', [
            'merchant_id' => $this->merchant->id,
        ] + $incoming_data);
    }

    /**
     * @test
     */
    public function update_category_was_changed()
    {
        $this->createService();
        $old_category = $this->createServiceCategory();
        $this->service_package->categories()->attach($old_category);
        $category = $this->createServiceCategory();
        $this->assertDatabaseHas('category_service', [
            'category_id' => $old_category->id,
            'service_id' => $this->service_package->id,
        ]);
        $incoming_data = [
            'title' => 'update title',
            'description' => 'update description',
            'active' => CategoryStatus::ACTIVE,
            'price' => 100.20,
            'category_id' => $category->id,
        ];
        $response = $this->put(route('services.update', $this->service_package), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('services.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('category_service', [
                'category_id' => $category->id,
                'service_id' => $this->service_package->id,
            ]);
        $this->assertDatabaseMissing('category_service', [
            'category_id' => $old_category->id,
            'service_id' => $this->service_package->id,
        ]);
    }

    /**
     * @test
     */
    public function update_category_was_attach()
    {
        $this->createService();
        $category = $this->createServiceCategory();
        $incoming_data = [
            'title' => 'update title',
            'description' => 'update description',
            'active' => CategoryStatus::ACTIVE,
            'price' => 100.20,
            'category_id' => $category->id,
        ];
        $response = $this->put(route('services.update', $this->service_package), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('services.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('category_service', [
            'category_id' => $category->id,
            'service_id' => $this->service_package->id,
        ]);
    }


    /**
     * @test
     */
    public function update_category_was_created()
    {
        $this->createService();
        $incoming_data = [
            'title' => 'update title',
            'description' => 'update description',
            'active' => CategoryStatus::ACTIVE,
            'price' => 100.20,
            'category_title' => 'new_category',
        ];
        $response = $this->put(route('services.update', $this->service_package), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('services.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('service_categories', [
            'title' => 'new_category',
            'description' => null,
            'active' => CategoryStatus::ACTIVE,
        ]);

        $service_category = ServiceCategory::toMe()->latest()->first();

        $this->assertDatabaseHas('category_service', [
            'category_id' => $service_category->id,
            'service_id' => $this->service_package->id,
        ]);
    }


    /**
     * @test
     */
    public function delete_voucher_was_removed()
    {
        $this->createService();

        $response = $this->delete(route('services.destroy', $this->service_package));

        $response->assertStatus(302)
            ->assertRedirect(route('services.index'))
            ->assertSessionHas('info');

        $this->assertDatabaseMissing('services', [
                'id' => $this->service_package->id,
            ]);
    }

    protected function createService(): void
    {
        $this->service_package = factory(Service::class)->create([
            'merchant_id' => $this->merchant->id,
        ]);
    }

    protected function createServiceCategory(): ServiceCategory
    {
        return factory(ServiceCategory::class)->create([
            'merchant_id' => $this->merchant->id,
        ]);
    }

    /**
     * @return array
     */
    protected function getIncomingParameters(): array
    {
        $this->createService();
        $incoming_data = [
            'title' => 'title',
            'description' => 'description',
            'active' => ServiceStatus::ACTIVE,
            'price' => 100.20,
            'services' => [$this->service_package->id]
        ];

        return $incoming_data;
    }
}
