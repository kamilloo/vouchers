<?php

namespace Tests\Feature\App\Http\Controllers\Checkout\Proceed\StarterTest;

use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\User;
use App\Models\Voucher;
use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class CheckoutControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Voucher
     */
    private $voucher;
    private $merchant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->merchant = factory(Merchant::class)->create();
    }

    /**
     * @test
     */
    public function proceed_validation_exception()
    {
        $redirect_url = route('checkout.start', $this->merchant);
        $response = $this->call(Request::METHOD_POST, route('checkout.proceed', $this->merchant), [
            'voucher_id' => false
        ], [],[],['HTTP_REFERER' => $redirect_url]);

        $response->assertStatus(302)->assertRedirect($redirect_url);
    }

    /**
     * @test
     */
    public function proceed_add_order_to_db()
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
        $response = $this->post(route('checkout.proceed', $this->merchant), $incoming_data);

        $response->assertStatus(302)->assertRedirect(route('checkout.confirmation', $this->merchant))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('orders', $incoming_data);
    }

    protected function createVoucher()
    {
        return factory(Voucher::class)->create();
    }
}
