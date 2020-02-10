<?php

namespace Tests\Feature\App\Http\Controllers\PaymentController\CallbackReturn;

use App\Contractors\IPaymentGateway;
use App\Models\Enums\DeliveryType;
use App\Models\Enums\StatusType;
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
        $this->merchant = factory(Merchant::class)->create();
        $this->order = factory(Order::class)->create([
            'status' => StatusType::NEW,
        ]);
        $this->payment = factory(Payment::class)->create([
            'payment_link' => $this->payment_url,
        ]);

        $this->payment_url = route('payment.recap', [
            'payment' => $this->payment,
        ]);

        $this->payment_gateway = \Mockery::mock(IPaymentGateway::class);
    }

    /**
     * @test
     */
    public function create_redirect_to_payment_gateway()
    {
        $this->mockPaymentGatewayMethodVerify();
        $response = $this->get(route('payment.return', $this->payment));
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


    protected function mockPaymentGatewayMethodVerify(): void
    {
        $this->app->instance(IPaymentGateway::class, $this->payment_gateway);
        $this->payment_gateway->shouldReceive('verify')
            ->once()
            ->andReturn(true);
    }
}
