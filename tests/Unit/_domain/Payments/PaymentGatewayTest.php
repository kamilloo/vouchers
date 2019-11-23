<?php

namespace Tests\Unit\Domain\Payments;

use App\Contractors\IOrder;
use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
use Devpark\Transfers24\Requests\Transfers24;
use Devpark\Transfers24\Responses\Register;
use Devpark\Transfers24\Responses\Register as RegisterResponse;
use Domain\Payments\PaymentGateway;
use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Mockery as m;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class PaymentGatewayTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Merchant
     */
    private $merchant;

    /**
     * @var Order|IOrder
     */
    private $order;

    /**
     * @var PaymentGateway
     */
    private $gateway;

    /**
     * @var Transfers24|m\MockInterface
     */
    private $transfer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->voucher = \factory(Voucher::class)->create([
            'type' => VoucherType::QUOTE
        ]);
        $this->order = \factory(Order::class)->create([
            'voucher_id' => $this->voucher->id
        ]);
        $this->merchant = \factory(Merchant::class)->create();

        $this->transfer = m::mock(Transfers24::class);
        $this->gateway = $this->app->make(PaymentGateway::class, [
            'gateway' => $this->transfer
        ]);


    }

    /**
     * @test
     */
    public function pay_create_payment()
    {
        $payment_link = 'payment_link';

        $register_response = $this->mockRegisterResponse($payment_link);

        $this->mockTransfer($register_response);

        $this->gateway->pay($this->order, $this->merchant);

        $this->assertDatabaseHas('payments', [
            'order_id' => $this->order->id,
            'merchant_id' => $this->merchant->id,
            'payment_link' => $payment_link
        ]);
    }

    /**
     * @param string $payment_link
     *
     * @return RegisterResponse|m\MockInterface
     */
    protected function mockRegisterResponse(string $payment_link)
    {
        $register_response = m::mock(Register::class);
        $register_response->shouldReceive('isSuccess')
            ->once()
            ->andReturn(true);
        $token = 'token';
        $register_response->shouldReceive('getToken')
            ->once()
            ->andReturn($token);

        $this->transfer->shouldReceive('execute')
            ->once()
            ->with($token)
            ->andReturn($payment_link);

        return $register_response;
}

    /**
     * @param $register_response
     */
    protected function mockTransfer($register_response): void
    {
        $this->transfer->shouldReceive('setUrlReturn', 'setUrlStatus',
            'setAmount',
            'setEmail',
            'setClientName',
            'setClientPhone',
            'setAddress',
            'setZipCode',
            'setCity',
            'setCountry',
            'setDescription'
//            'setArticle',
//            'setArticleDescription'
            )
            ->once()
            ->andReturnSelf();
        $this->transfer->shouldReceive('init')
            ->once()
            ->andReturn($register_response);
    }
}
