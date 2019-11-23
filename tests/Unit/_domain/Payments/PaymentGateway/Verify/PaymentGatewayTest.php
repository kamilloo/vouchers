<?php

namespace Tests\Unit\Domain\Payments\PaymentGateway\Verify;

use App\Contractors\IOrder;
use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
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

        $this->transfer = m::mock(Transfers24::class);
        $this->gateway = $this->app->make(PaymentGateway::class, [
            'gateway' => $this->transfer
        ]);

    }

    /**
     * @test
     */
    public function verify_payment_was_confirmed()
    {
        $payment = $this->createPayment([
            'paid_at' => Carbon::now(),
        ]);

        $verified = $this->gateway->verify($payment);

        $this->assertTrue($verified);

    }

    /**
     * @test
     */
    public function verify_payment_not_yet_confirm()
    {
        $payment = $this->createPayment([
            'paid_at' => null,
        ]);

        $verified = $this->gateway->verify($payment);

        $this->assertFalse($verified);

    }


    private function createPayment(array $attribute = []):Payment
    {
        return \factory(Payment::class)->create($attribute);
    }

}
