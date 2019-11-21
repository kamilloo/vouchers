<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Models\Enums\VoucherType;
use App\Models\Order;
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
        $this->createUserAndBeFromApi();

    }

    /**
     * @test
     */
    public function get_not_found_vourcher()
    {
        $order = factory(Order::class)->create();

        $response = $this->getJson(route('api-voucher-get', $order->qr_code));

        $response->assertStatus(404);
        $this->assertContains('No query results for model', $response->decodeResponseJson('message'));
    }

    /**
     * @test
     */
    public function get_order_founded_be_me()
    {
        $order = factory(Order::class)->make();
        $this->user->merchant->orders()->save($order);

        $response = $this->getJson(route('api-voucher-get', $order->qr_code));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function get_response_with_order()
    {
        $order = factory(Order::class)->make();
        $this->user->merchant->orders()->save($order);

        $response = $this->getJson(route('api-voucher-get', $order->qr_code));

        $response->assertJsonStructure([
            'data' => [
                'id',
                'price',
                'title',
                'type',
            ]
        ]);
    }



}
