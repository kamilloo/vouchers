<?php

namespace Tests\Unit\Domain\Payments\PaymentGateway\Confirmation;

use App\Contractors\IOrder;
use App\Http\Requests\PaymentCallbackStatus;
use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
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
        $this->merchant = \factory(Merchant::class)->create();

        $this->transfer = m::mock(Transfers24::class);
        $this->gateway = $this->app->make(PaymentGateway::class, [
            'gateway' => $this->transfer
        ]);


    }

    /**
     * @test
     */
    public function confirmation_create_transaction_confirmation()
    {
//        $order = $this->createOrderWithQuoteVoucher();
        $payment = \factory(Payment::class)->create();
        $request = PaymentCallbackStatus::createFromGlobals();
        $register_response = $this->mockRegisterResponse($request);

        $this->mockTransferForQuoteVoucher($register_response);

        $this->gateway->confirmation($payment, $request);

//        $this->assertDatabaseHas('payments', [
//            'order_id' => $order->id,
//            'merchant_id' => $this->merchant->id,
//        ]);

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
//        $register_response->shouldReceive('getToken')
//            ->once()
//            ->andReturn($token);
//        $register_response->shouldReceive('getSessionId')
//            ->once()
//            ->andReturn('session_id');
//        $register_response->shouldReceive('getRequestParameters')
//            ->once()
//            ->andReturn([]);
//
//        $this->transfer->shouldReceive('execute')
//            ->once()
//            ->with($token)
//            ->andReturn($payment_link);

        return $register_response;
}

    /**
     * @param $register_response
     */
    protected function mockTransferForQuoteVoucher($register_response): void
    {
//        $this->transfer->shouldReceive(
//            'setUrlReturn',
//            'setUrlStatus',
//            'setAmount',
//            'setEmail',
//            'setClientName',
//            'setClientPhone',
//            'setAddress',
//            'setZipCode',
//            'setCity',
//            'setCountry',
//            'setDescription'
//            )
//            ->once()
//            ->andReturnSelf();
        $this->transfer->shouldReceive('receive')
            ->once()
            ->andReturn($register_response);
    }


    /**
     * @param $register_response
     */
    protected function mockTransferForServiceVoucher($register_response): void
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
            'setDescription',
            'setArticle',
            'setArticleDescription'
        )
            ->once()
            ->andReturnSelf();
        $this->transfer->shouldReceive('init')
            ->once()
            ->andReturn($register_response);
    }

    protected function createOrderWithQuoteVoucher(array $attribute = []): Order
    {
        $voucher = $this->createQuoteVoucher();
        $order = $this->makeOrder($attribute);
        $order->voucher()->associate($voucher);
        $order->save();
        return $order;
    }


    protected function createOrderWithServiceVoucher(array $attribute = []): Order
    {
        $voucher = $this->createServiceVoucher();
        $order = $this->makeOrder($attribute);
        $order->voucher()->associate($voucher);
        $order->save();
        return $order;
    }

    /**
     * @return mixed
     */
    protected function createQuoteVoucher(array $attribute = []): Voucher
    {
        return \factory(Voucher::class)->state(VoucherType::QUOTE)->create($attribute);

    }

    /**
     * @return mixed
     */
    protected function createServiceVoucher(array $attribute = []): Voucher
    {
        $service = $this->createService();

        $voucher = $this->makeServiceVoucher($attribute);

        $voucher->product()->associate($service);
        $voucher->save();
        return $voucher;

    }

    protected function createService(array $attribute = []): Service
    {
        return \factory(Service::class)->create($attribute);
    }

    protected function makeOrder(array $attribute = []): Order
    {
        return \factory(Order::class)->make($attribute);
    }

    /**
     * @param array $attribute
     *
     * @return mixed
     */
    protected function makeServiceVoucher(array $attribute): Voucher
    {
        return \factory(Voucher::class)->state(VoucherType::SERVICE)->create($attribute);
    }

}
