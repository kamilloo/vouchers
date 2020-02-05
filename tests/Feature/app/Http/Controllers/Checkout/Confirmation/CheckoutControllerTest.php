<?php

namespace Tests\Feature\App\Http\Controllers\Checkout\Confirmation;

use App\Models\Enums\DeliveryType;
use App\Models\Enums\StatusType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Order;
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
     * @var Merchant
     */
    private $merchant;
    /**
     * @var Order
     */
    private $order;

    protected function setUp(): void
    {
        parent::setUp();
        $this->merchant = factory(Merchant::class)->create();
        $this->order = factory(Order::class)->create([
            'merchant_id' => $this->merchant->id,
            'status' => StatusType::NEW
        ]);
    }

    /**
     * @test
     */
    public function confirmation_has_order_and_get_200()
    {
        $response = $this->get(route('checkout.confirmation', [
            'merchant' =>$this->merchant,
            'order' => $this->order,
        ]));

        $response->assertOk()
            ->assertViewHas(['order', 'merchant'])
            ->assertViewIs('checkout.confirmation');
    }


}
