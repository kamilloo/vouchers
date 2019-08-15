<?php

namespace Tests\Feature\App\Http\StarterTest;

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
        $this->payment_url = 'payment_url';
        $this->merchant = factory(Merchant::class)->create();
        $this->order = factory(Order::class)->create();
        $this->payment = factory(Payment::class)->create();
    }

    /**
     * @test
     */
    public function create_redirect_to_payment_gateway()
    {
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
        $this->voucher = $this->createVoucher();
        $faker = Factory::create();
        $incoming_data = [
            'voucher_id' => $this->voucher->id,
            'delivery' => DeliveryType::ONLINE,
            'price' => 300,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'phone' => $faker->phoneNumber,
            'email' => $faker->email,
        ];
        $response = $this->post(route('checkout.proceed'), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('checkout.confirmation'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('payments', $incoming_data);
    }

    protected function createVoucher()
    {
        return factory(Voucher::class)->create();
    }
}
