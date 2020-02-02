<?php

namespace Tests\Feature\App\Http\Controllers\PaymentController\Create;

use App\Contractors\IPaymentGateway;
use App\Models\Enums\DeliveryType;
use App\Models\Enums\StatusType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserProfile;
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

    public function redirectToHomepageProvider()
    {
        return [
            StatusType::CANCELLED => [StatusType::CANCELLED],
            StatusType::RETURNED => [StatusType::RETURNED],
        ];
    }

    public function redirectToRecapProvider()
    {
        return [
            StatusType::WAITING => [StatusType::WAITING],
            StatusType::CONFIRM => [StatusType::CONFIRM],
            StatusType::SENT => [StatusType::SENT],
            StatusType::DELIVERY => [StatusType::DELIVERY],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->merchant = factory(Merchant::class)->create();

        $this->payment_gateway = \Mockery::mock(IPaymentGateway::class);
        $this->app->instance(IPaymentGateway::class, $this->payment_gateway);

    }

    /**
     * @test
     */
    public function create_redirect_to_payment_gateway()
    {
        $this->order = $this->createOrder(StatusType::NEW, []);
        $this->payment_url = Factory::create()->url;
        $this->payment = $this->createPayment([
            'payment_link' => $this->payment_url
        ]);

        $this->mockPaymentGatewayMethodPay();
        $response = $this->get(route('payment.create', [
            'merchant' => $this->merchant,
            'order' => $this->order]));
        $response->assertStatus(302)
            ->assertRedirect($this->payment_url);
    }

    /**
     * @test
     * @dataProvider
     */
    public function create_redirect_to_failed_page()
    {
        $this->order = $this->createOrder(StatusType::REJECTED, []);
        $this->mockPaymentGatewayWithoutMethodPay();

        $redirect_link = route('voucher.failed', [
            'order' => $this->order,
        ]);
        $response = $this->get(route('payment.create', [
            'merchant' => $this->merchant,
            'order' => $this->order]));
        $response->assertStatus(302)
            ->assertRedirect($redirect_link);
    }


    /**
     * @test
     * @dataProvider redirectToRecapProvider
     */
    public function create_redirect_to_recap(string $status)
    {
        $this->order = $this->createOrder($status, []);
        $this->payment = $this->order->payments()->save($this->makePayment([]));
        $this->mockPaymentGatewayWithoutMethodPay();

        $redirect_link = route('payment.recap', [
            'payment' => $this->payment,
        ]);
        $response = $this->get(route('payment.create', [
            'merchant' => $this->merchant,
            'order' => $this->order]));
        $response->assertStatus(302)
            ->assertRedirect($redirect_link);
    }

    /**
     * @test
     * @dataProvider redirectToHomepageProvider
     */
    public function create_redirect_to_homepage(string $status)
    {
        $this->order = $this->createOrder($status, []);
        $this->payment = $this->order->payments()->save($this->makePayment([]));
        $this->mockPaymentGatewayWithoutMethodPay();
        $this->addProfileHomepage();
        $response = $this->get(route('payment.create', [
            'merchant' => $this->merchant,
            'order' => $this->order]));
        $response->assertStatus(302)
            ->assertRedirect($this->merchant->user->profile->homepage);
    }


    protected function mockPaymentGatewayMethodPay(): void
    {
        $this->payment_gateway->shouldReceive('pay')
            ->once()
            ->andReturn($this->payment);
    }


    protected function mockPaymentGatewayWithoutMethodPay(): void
    {
        $this->app->instance(IPaymentGateway::class, $this->payment_gateway);
        $this->payment_gateway->shouldNotReceive('pay');
    }

    protected function createOrder(string $status, array $attributes): Order
    {
        return factory(Order::class)->state($status)->create($attributes);
    }

    /**
     * @return mixed
     */
    protected function createPayment(array $attributes): Payment
    {
        return factory(Payment::class)->create($attributes);
    }

    /**
     * @return mixed
     */
    protected function makePayment(array $attributes): Payment
    {
        return factory(Payment::class)->make($attributes);
    }

    protected function addProfileHomepage()
    {
        $faker = Factory::create();
        $this->merchant->user->profile()->save(\factory(UserProfile::class)->make([
            'homepage' => $faker->url
        ]));
        $this->merchant->user->refresh();
    }
}
