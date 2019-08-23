<?php

namespace Tests\Feature\App\Http\Controllers\PaymentController\SandboxGateway;

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

    protected function setUp(): void
    {
        parent::setUp();
        $this->merchant = factory(Merchant::class)->create();
        $this->order = factory(Order::class)->create();
        $this->payment = factory(Payment::class)->create([
            'payment_link' => $this->payment_url
        ]);
        $this->payment_url = route('payment.return', $this->payment);
    }

    /**
     * @test
     */
    public function create_redirect_to_payment_gateway()
    {
        $response = $this->get(route('payment.sandbox-gateway', $this->payment));
        $response->assertStatus(302)
            ->assertRedirect($this->payment_url);
    }
}
