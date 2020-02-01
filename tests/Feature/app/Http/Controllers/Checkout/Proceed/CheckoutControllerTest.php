<?php

namespace Tests\Feature\App\Http\Controllers\Checkout\Proceed;

use App\Events\OrderWasPlaced;
use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
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
        \Event::fake();
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
        $incoming_data = $this->incomingData();
        $response = $this->post(route('checkout.proceed', $this->merchant), $incoming_data);

        $response->assertStatus(302)
            ->assertSessionHas('success');

        $client = Arr::pull($incoming_data, 'client');
        $this->assertDatabaseHas('orders', $incoming_data);

        $this->assertDatabaseHas('clients', $client);

        \Event::assertDispatched(OrderWasPlaced::class);

    }


    /**
     * @test
     */
    public function proceed_redirect_to_confirmation_page()
    {
        $this->voucher = $this->createVoucher();
        $faker = Factory::create();
        $incoming_data = $this->incomingData();
        $response = $this->post(route('checkout.proceed', $this->merchant), $incoming_data);

        $order =  Order::latest()->first();

        $response->assertStatus(302)
            ->assertRedirect(route('checkout.confirmation', [
                'merchant' => $this->merchant,
                'order' => $order
            ]))
            ->assertSessionHas('success');

    }

    protected function createVoucher()
    {
        return factory(Voucher::class)->create();
    }

    /**
     * @param \Faker\Generator $faker
     *
     * @return array
     */
    protected function incomingData(): array
    {
        $faker = Factory::create();

        return [
            'voucher_id' => $this->voucher->id,
            'delivery' => DeliveryType::ONLINE,
            'price' => 300,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'phone' => $faker->phoneNumber,
            'email' => $faker->email,
            'client' => [
                'email' => $faker->email,
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'city' => $faker->city,
                'address' => $faker->address,
                'postcode' => $faker->postcode,
                'country' => $faker->country,
            ]
        ];
    }
}
