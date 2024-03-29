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
     * @var Service
     */
    protected $service;
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
            'categories' => [$category->id],
            'category_title' => false,
            'services' => [$service->id],
        ], [],[],['HTTP_REFERER' => $redirect_url]);

        $response->assertStatus(302)->assertRedirect($redirect_url);
        $response->assertSessionHasErrors([
            'title',
            'description',
            'active',
            'price',
            'categories.0',
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

        $incoming_data['categories'] = [$service_category->id];

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
    public function store_service_was_attach_to_new_package()
    {
        $service_category = factory(ServiceCategory::class)->make();
        $this->merchant->services()->save($service_category);
        $incoming_data = $this->getIncomingParameters();

        $response = $this->post(route('service-packages.store'), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('service-packages.index'))->assertSessionHas('success');

        $service_package = ServicePackage::toMe()->latest()->first();

        $this->assertDatabaseHas('package_service', [
            'service_id' => $incoming_data['services'][0],
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
        $this->createServicePackage();
        $redirect_url = route('service-packages.edit', $this->service_package);
        $response = $this->call(Request::METHOD_PUT, route('service-packages.update', $this->service_package), [
            'title' => false,
            'description' => false,
            'active' => 'no boolean',
            'price' => 'no valud price',
            'categories' => [$service_category->id],
            'category_title' => false,
        ], [],[],['HTTP_REFERER' => $redirect_url]);

        $response->assertStatus(302)->assertRedirect($redirect_url);
        $response->assertSessionHasErrors([
            'title',
            'description',
            'active',
            'price',
            'categories.0',
            'category_title',
            'services'
        ]);
    }

    /**
     * @test
     */
    public function update_service_was_updated()
    {
        $this->createServicePackage();

        $incoming_parameters = $this->getIncomingParameters();

        $response = $this->put(route('service-packages.update', $this->service_package), $incoming_parameters);

        $response->assertStatus(302)->assertRedirect(route('service-packages.index'))->assertSessionHas('success');
    }

    /**
     * @test
     */
    public function update_database_was_updated()
    {
        $this->createServicePackage();
        $incoming_data = $this->getIncomingParameters();

        $response = $this->put(route('service-packages.update', $this->service_package), $incoming_data);

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
    public function update_category_was_changed()
    {
        $this->createServicePackage();
        $old_category = $this->createServiceCategory();
        $this->service_package->categories()->attach($old_category);
        $category = $this->createServiceCategory();
        $this->assertDatabaseHas('category_package', [
            'category_id' => $old_category->id,
            'package_id' => $this->service_package->id,
        ]);
        $incoming_data = $this->getIncomingParameters();
        $incoming_data['categories'] = [$category->id];
        $response = $this->put(route('service-packages.update', $this->service_package), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('service-packages.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('category_package', [
                'category_id' => $category->id,
                'package_id' => $this->service_package->id,
            ]);
        $this->assertDatabaseMissing('category_package', [
            'category_id' => $old_category->id,
            'package_id' => $this->service_package->id,
        ]);
    }

    /**
     * @test
     */
    public function update_category_was_attach()
    {
        $this->createServicePackage();
        $category = $this->createServiceCategory();
        $incoming_data = $this->getIncomingParameters();
        $incoming_data['categories'] = [$category->id];
        $response = $this->put(route('service-packages.update', $this->service_package), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('service-packages.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('category_package', [
            'category_id' => $category->id,
            'package_id' => $this->service_package->id,
        ]);
    }


    /**
     * @test
     */
    public function update_category_was_created()
    {
        $this->createServicePackage();

        $incoming_data = $this->getIncomingParameters();
        $incoming_data['category_title'] = 'new_category';
        $response = $this->put(route('service-packages.update', $this->service_package), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('service-packages.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('service_categories', [
            'title' => 'new_category',
            'description' => null,
            'active' => CategoryStatus::ACTIVE,
        ]);

        $service_category = ServiceCategory::toMe()->latest()->first();

        $this->assertDatabaseHas('category_package', [
            'category_id' => $service_category->id,
            'package_id' => $this->service_package->id,
        ]);
    }

    /**
     * @test
     */
    public function update_services_was_attach()
    {
        $this->createServicePackage();
        $incoming_data = $this->getIncomingParameters();
        $response = $this->put(route('service-packages.update', $this->service_package), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('service-packages.index'))->assertSessionHas('success');

        $this->assertDatabaseHas('package_service', [
            'service_id' => $incoming_data['services'][0],
            'package_id' => $this->service_package->id,
        ]);
    }


    /**
     * @test
     */
    public function delete_voucher_was_removed()
    {
        $this->createServicePackage();
        $this->createService();

        $response = $this->delete(route('service-packages.destroy', $this->service_package));

        $service_id = $this->service->id;
        $deleted_service_id = $this->service_package->id;
        $response->assertStatus(302)
            ->assertRedirect(route('service-packages.index'))
            ->assertSessionHas('info');


        $this->assertDatabaseMissing('package_service', [
            'service_id' => $service_id,
            'package_id' => $deleted_service_id,
        ]);
        $this->assertDatabaseMissing('service_packages', [
                'id' => $deleted_service_id,
            ]);
    }

    protected function createService(): void
    {
        $this->service = factory(Service::class)->create([
            'merchant_id' => $this->merchant->id,
        ]);
    }

    protected function createServicePackage(): void
    {
        $this->service_package = factory(ServicePackage::class)->create([
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
            'services' => [$this->service->id]
        ];

        return $incoming_data;
    }
}
