<?php

namespace Tests\Feature\App\Http\Controllers\VoucherOrderController\Download;

use App\Models\Enums\VoucherType;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Mockery as m;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class VoucherOrderControllerTest extends TestCase
{
    use RefreshDatabase;



    /**
     * @var Voucher
     */
    private $voucher;
    /**
     * @var Order
     */
    private $order;
    /**
     * @var PDF|m\MockInterface
     */
    private $pdf_service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pdf_service = m::mock(PDF::class);

        $this->app->instance(PDF::class, $this->pdf_service);
        $this->order = factory(Order::class)->create();
    }

    /**
     * @test
     */
    public function download_get_pdf()
    {
        $this->pdf_service->shouldReceive('loadView')
            ->with('pdf.voucher', m::any())
            ->once()
            ->andReturnSelf();
        $response = Response::create();
        $this->pdf_service->shouldReceive('download')
            ->once()
            ->andReturn($response);

        $response = $this->get(route('voucher.download', $this->order));
        $response->assertStatus(200);
    }
}
