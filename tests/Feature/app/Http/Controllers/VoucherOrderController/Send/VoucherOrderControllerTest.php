<?php

namespace Tests\Feature\App\Http\Controllers\VoucherOrderController\Send;

use App\Mail\SendVoucher;
use App\Models\Enums\StatusType;
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
        $this->order = factory(Order::class)->states(StatusType::CONFIRM)->create();

        Mail::fake();
    }


    /**
     * @test
     */
    public function store_validation_exception()
    {
        //When
        $redirect_url = route('service-categories.create');

        //Then
        $response = $this->call(Request::METHOD_POST, route('voucher.send', $this->order), [
            'email' => false,
        ], [],[],['HTTP_REFERER' => $redirect_url]);

        //Assert
        $response->assertStatus(302)->assertRedirect($redirect_url);
        $response->assertSessionHasErrors([
            'email',
        ]);
    }


    /**
     * @test
     */
    public function send_pdf()
    {
        //Given
        $email = 'email@email.com';

        //When
        $this->loadViewAndRenderPdf();

        //Then
        $response = $this->sendVoucherSendRequest(compact('email'));

        //Assert
        $response->assertStatus(302);
        $response->assertSessionHas('success', __('Mail was send successful!'));
    }


    /**
     * @test
     */
    public function send_notification_was_sent()
    {
        //Given
        $email = 'email@email.com';

        //When
        $this->loadViewAndRenderPdf();

        //Then
        $response = $this->sendVoucherSendRequest(compact('email'));

        //Assert
        Mail::assertSent(SendVoucher::class, function (SendVoucher $mail) use ($email){
            return $mail->hasTo($email)
                && in_array('raw data', $mail->rawAttachments[0]);
        });

    }

    /**
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function sendVoucherSendRequest(array $entry_data): \Illuminate\Foundation\Testing\TestResponse
    {
        return $this->post(route('voucher.send', $this->order), $entry_data);
    }

    protected function loadViewAndRenderPdf(): void
    {
        $this->pdf_service->shouldReceive('loadView')
            ->with('pdf.voucher', m::any())
            ->once()
            ->andReturnSelf();
        $this->pdf_service->shouldReceive('output')
            ->once()
            ->andReturn('raw data');
    }

}
