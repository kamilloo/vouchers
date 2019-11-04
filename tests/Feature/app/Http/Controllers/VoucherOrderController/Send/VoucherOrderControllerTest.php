<?php

namespace Tests\Feature\App\Http\Controllers\VoucherOrderController\Send;

use App\Mail\SendVoucher;
use App\Models\Enums\VoucherType;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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

        Mail::fake();
    }

    /**
     * @test
     */
    public function send_pdf()
    {
        $this->pdf_service->shouldReceive('loadView')
            ->with('pdf.voucher', m::any())
            ->once()
            ->andReturnSelf();
        $this->pdf_service->shouldReceive('output')
            ->once();

        $response = $this->get(route('voucher.send', $this->order));
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Mail was send successful!');
    }


    /**
     * @test
     */
    public function send_notification_was_sent()
    {
        $this->pdf_service->shouldReceive('loadView')
            ->with('pdf.voucher', m::any())
            ->once()
            ->andReturnSelf();
        $this->pdf_service->shouldReceive('output')
            ->once()
            ->andReturn('raw data');

        $response = $this->get(route('voucher.send', $this->order));

        Mail::assertSent(SendVoucher::class, function (SendVoucher $mail) use ($response){
            return $mail->hasTo($this->order->email)
                && in_array('raw data', $mail->rawAttachments[0]);
        });

    }


}
