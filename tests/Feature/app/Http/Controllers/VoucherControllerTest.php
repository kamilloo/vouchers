<?php

namespace Tests\Feature\App\Http\StarterTest;

use App\Models\Enums\VoucherType;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\UploadedFile;
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
    public function update_got_403_authorization_denied()
    {
        $this->voucher = factory(Voucher::class)->create();
        $response = $this->post(route('vouchers.update', $this->voucher));
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function update_validation_exception()
    {
        $this->voucher = factory(Voucher::class)->state('mine')->create();
        $redirect_url = route('vouchers.edit', $this->voucher);
        $response = $this->call(Request::METHOD_POST, route('vouchers.update', $this->voucher), [
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
        $response = $this->post(route('vouchers.update', $this->voucher), [
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
        $response = $this->post(route('vouchers.update', $this->voucher), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('vouchers.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('vouchers', [
            'user_id' => $this->user->id,
        ] + $incoming_data);
    }
}
