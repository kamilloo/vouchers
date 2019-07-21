<?php

namespace Tests\Feature\App\Http\StarterTest;

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
        $response = $this->get(route('vouchers.index'));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function update_incoming_data()
    {
        $this->voucher = factory(Voucher::class)->state('mine')->create();
        $redirect_url = route('vouchers.edit', $this->voucher);
        $response = $this->call(Request::METHOD_POST, route('vouchers.update', $this->voucher), [
            'address' => false
        ], [],[],['HTTP_REFERER' => $redirect_url]);

        $response->assertStatus(302)->assertRedirect($redirect_url);
    }

    /**
     * @test
     */
    public function update_user_not_change_data()
    {
        $response = $this->post(route('vouchers.update'));

        $response->assertStatus(302)->assertRedirect(route('vouchers.index'))->assertSessionHas('success');
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
            'services' => 'some data',
            'description' => 'some data',
            'branch' => 'some data',
        ];
        $this->post(route('vouchers.update'), $incoming_data)
            ->assertRedirect(route('vouchers.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('user_voucherss', [
            'user_id' => $this->user->id,
        ] + $incoming_data);
    }

    /**
     * @test
     */
    public function update_logo_was_stored()
    {
        $this->createUserAndBe();
        $incoming_data = [
            'logo' => $this->file
        ];
        $this->post(route('vouchers.update'), $incoming_data);

        $logo_file_name = $this->user->vouchers->logo;
        Storage::assertExists($logo_file_name);

    }
}
