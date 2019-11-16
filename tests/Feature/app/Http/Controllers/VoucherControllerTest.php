<?php

namespace Tests\Feature\App\Http;

use App\Models\Enums\VoucherType;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class VoucherControllerTest extends TestCase
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

    /**
     * @var Voucher
     */
    private $voucher;

    protected function setUp(): void
    {
        parent::setUp();
        $this->file_factory = UploadedFile::fake();
        $this->file = $this->file_factory->image('png');
        $this->createUserAndBe();

    }

    /**
     * @test
     */
    public function index_get_vouchers_list()
    {
        $response = $this->get(route('vouchers.index'))
            ->assertViewHas('vouchers');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function index_get_vouchers_create()
    {
        $response = $this->get(route('vouchers.create'))
            ->assertViewIs('vouchers.create');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store_validation_exception()
    {
        $redirect_url = route('vouchers.create');
        $response = $this->call(Request::METHOD_POST, route('vouchers.store'), [
            'type' => false
        ], [],[],['HTTP_REFERER' => $redirect_url]);

        $response->assertStatus(302)->assertRedirect($redirect_url);
    }

    /**
     * @test
     */
    public function store_add_voucher_do_db()
    {
        $incoming_data = [
            'title' => 'title',
            'type' => VoucherType::SERVICE,
            'service' => 'service'
        ];
        $response = $this->post(route('vouchers.store'), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('vouchers.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('vouchers', [
                'user_id' => $this->user->id,
            ] + $incoming_data);
    }


    /**
     * @test
     */
    public function store_file_for_voucher_db()
    {
        $incoming_data = [
            'file-name' => $this->file,
            'title' => 'title',
            'type' => VoucherType::SERVICE,
            'service' => 'service'
        ];
        $response = $this->post(route('vouchers.store'), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('vouchers.index'))
            ->assertSessionHas('success');


        $voucher = Voucher::latest()->first();

        $this->assertContains('public/vouchers', $voucher->file);

        Storage::assertExists($voucher->file);
    }

    /**
     * @test
     */
    public function store_add_voucher_to_merchant()
    {
        $incoming_data = [
            'title' => 'title',
            'type' => VoucherType::SERVICE,
            'service' => 'service'
        ];
        $response = $this->post(route('vouchers.store'), $incoming_data)->assertStatus(302);

        $this->assertDatabaseHas('merchant_voucher', [
                'merchant_id' => $this->user->merchant->id,
                'voucher_id' => DB::table('vouchers')->latest()->first()->id
            ]);
    }


    /**
     * @test
     */
    public function update_got_403_authorization_denied()
    {
        $this->voucher = factory(Voucher::class)->create();
        $response = $this->put(route('vouchers.update', $this->voucher));
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function update_validation_exception()
    {
        $this->voucher = factory(Voucher::class)->state('mine')->create();
        $redirect_url = route('vouchers.edit', $this->voucher);
        $response = $this->call(Request::METHOD_PUT, route('vouchers.update', $this->voucher), [
            'type' => false
        ], [],[],['HTTP_REFERER' => $redirect_url]);

        $response->assertStatus(302)->assertRedirect($redirect_url);
    }

    /**
     * @test
     */
    public function update_voucher_was_updated()
    {
        $this->voucher = factory(Voucher::class)->state('mine')->create();
        $response = $this->put(route('vouchers.update', $this->voucher), [
            'title' => 'title',
            'type' => VoucherType::SERVICE,
            'service' => 'service'
        ]);

        $response->assertStatus(302)->assertRedirect(route('vouchers.index'))->assertSessionHas('success');
    }

    /**
     * @test
     */
    public function update_database_was_updated()
    {
        $this->voucher = factory(Voucher::class)->state('mine')->create();
        $incoming_data = [
            'title' => 'title',
            'type' => VoucherType::SERVICE,
            'service' => 'service'
        ];
        $response = $this->put(route('vouchers.update', $this->voucher), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('vouchers.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('vouchers', [
            'user_id' => $this->user->id,
        ] + $incoming_data);
    }

    /**
     * @test
     */
    public function delete_voucher_was_removed()
    {
        $this->voucher = factory(Voucher::class)->state('mine')->create();

        $response = $this->delete(route('vouchers.destroy', $this->voucher));

        $response->assertStatus(302)
            ->assertRedirect(route('vouchers.index'))
            ->assertSessionHas('info');

        $this->assertDatabaseMissing('vouchers', [
                'id' => $this->voucher->id,
            ]);
    }
}
