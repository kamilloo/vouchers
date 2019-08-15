<?php

namespace Tests\Feature\App\Http\Controllers\PaymentController\Create;

use App\Contractors\IPaymentGateway;
use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\Voucher;
use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Voucher
     */
    private $voucher;
    /**
     * @var string
     */
    private $payment_url;
    /**
     * @var Merchant
     */
    private $merchant;
    /**
     * @var Order
     */
    private $order;

    /**
     * Payment
     */
    private $payment;
    /**
     * @var IPaymentGateway|\Mockery\MockInterface
     */
    private $payment_gateway;

    protected function setUp(): void
    {
        parent::setUp();
        $this->payment_url = 'payment_url';
        $this->merchant = factory(Merchant::class)->create();
        $this->order = factory(Order::class)->create();
        $this->payment = factory(Payment::class)->create([
            'payment_link' => $this->payment_url
        ]);
        $this->payment_gateway = \Mockery::mock(IPaymentGateway::class);
    }

    /**
     * @test
     */
    public function create_redirect_to_payment_gateway()
    {
        $this->mockPaymentGatewayMethodPay();
        $response = $this->get(route('payment.create', [
            'merchant' => $this->merchant,
            'order' => $this->order]));
        $response->assertStatus(302)
            ->assertRedirect($this->payment_url);
    }

    /**
     * @test
     */
    public function create_add_payment_to_db()
    {
        $this->markTestSkipped('need implement payment gateway');
    }


    protected function mockPaymentGatewayMethodPay(): void
    {
        $this->app->instance(IPaymentGateway::class, $this->payment_gateway);
        $this->payment_gateway->shouldReceive('pay')
            ->once()
            ->andReturn($this->payment);
    }
}
