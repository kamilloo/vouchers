<?php

namespace Tests\Feature\App\Http;

use App\Models\Enums\VoucherType;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();
        $this->createUserAndBe();
    }

    /**
     * @test
     */
    public function index_get_payments_list()
    {
        $response = $this->get(route('payments.index'))
            ->assertViewHas('payments');

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
