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
use App\Models\Transaction;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Devpark\Transfers24\Requests\Transfers24;
use Devpark\Transfers24\Responses\Register;
use Devpark\Transfers24\Responses\Register as RegisterResponse;
use Domain\Payments\PaymentGateway;
use Faker\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    public function confirmation_payment_not_found_per_session_id()
    {
        $this->expectException(ModelNotFoundException::class);

        $payment = \factory(Payment::class)->create();
        $request = PaymentCallbackStatus::createFromGlobals();

        $register_response = $this->mockRegisterResponseWhenModelNotFoundExceptionOccur();

        $this->mockTransfer($register_response, $request);

        $this->gateway->confirmation($payment, $request);

        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'paid_at' => null
        ]);

    }

    /**
     * @test
     */
    public function confirmation_create_transaction_confirmation()
    {
        $payment = \factory(Payment::class)->create();

        $session_id = 'session_id';
        $this->createTransaction($payment, compact('session_id'));

        $request = PaymentCallbackStatus::createFromGlobals();
        $register_response = $this->mockRegisterResponse(compact('session_id'));

        $this->mockTransfer($register_response, $request);

        $this->gateway->confirmation($payment, $request);

        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'paid_at' => Carbon::now()
        ]);

    }

    /**
     * @param string $payment_link
     *
     * @return RegisterResponse|m\MockInterface
     */
    protected function mockRegisterResponse(array $attribute)
    {
        $register_response = m::mock(Register::class);
        $register_response->shouldReceive('isSuccess')
            ->once()
            ->andReturn(true);
        $register_response->shouldReceive('getSessionId')
            ->once()
            ->andReturn($attribute['session_id']);
        $register_response->shouldReceive('getRequestParameters', 'getReceiveParameters')
            ->once()
            ->andReturn([]);
        $register_response->shouldReceive('getErrorDescription')
            ->once()
            ->andReturn(null);
        $register_response->shouldReceive('getErrorCode')
            ->once()
            ->andReturn(0);
        $register_response->shouldReceive('getOrderId')
            ->once()
            ->andReturn('order_id');

        return $register_response;
    }

    /**
     * @param string $payment_link
     *
     * @return RegisterResponse|m\MockInterface
     */
    protected function mockRegisterResponseWhenModelNotFoundExceptionOccur()
    {
        $register_response = m::mock(Register::class);
        $register_response->shouldReceive('isSuccess')
            ->once()
            ->andReturn(true);
        $register_response->shouldReceive('getSessionId')
            ->once()
            ->andReturn('session_id');
        $register_response->shouldNotReceive('getRequestParameters', 'getReceiveParameters', 'getErrorDescription', 'getErrorCode', 'getOrderId');

        return $register_response;
    }

    /**
     * @param $register_response
     */
    protected function mockTransfer($register_response, $request): void
    {
        $this->transfer->shouldReceive('receive')
            ->once()
            ->with($request)
            ->andReturn($register_response);
    }

    protected function makeTransaction(array $attribute): Transaction
    {
        return \factory(Transaction::class)->make($attribute);
    }

    /**
     * @param $payment
     */
    protected function createTransaction($payment, array $attribute): void
    {
        $transaction = $this->makeTransaction($attribute);
        $transaction->payment()->associate($payment);
        $transaction->save();
    }
}
