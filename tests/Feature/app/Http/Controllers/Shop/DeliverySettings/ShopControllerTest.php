<?php

namespace Tests\Feature\App\Http\Controllers\Shop\DeliverySettings;

use App\Models\Enums\BackgroundColorType;
use App\Models\Enums\DeliveryStatus;
use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\ShopStyle;
use App\Models\Template;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class ShopControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Voucher
     */
    private $voucher;

    /**
     * @var Merchant
     */
    protected $merchant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createUserAndBe();
        $this->merchant = $this->user->merchant;
    }

    /**
     * @test
     */
    public function deliverySetting_validation_exception()
    {
        $entry_data = [
            'delivery' => false,
        ];
        $response = $this->sendStoreDeliverySettingsRequest($entry_data)->assertStatus(422);

        $this->assertArrayHasKey('delivery', $response->decodeResponseJson('errors'));
    }


    /**
     * @test
     */
    public function deliverySetting_types_validation_exception()
    {
        $entry_data = [
            'delivery' => [[
                'type' => false,
                'cost' => 'invalid_value',
                'status' => 'invalid_value',
            ]]
        ];
        $response = $this->sendStoreDeliverySettingsRequest($entry_data)->assertStatus(422);

        $this->assertArrayHasKey('delivery.0.type', $response->decodeResponseJson('errors'));
        $this->assertArrayHasKey('delivery.0.cost', $response->decodeResponseJson('errors'));
        $this->assertArrayHasKey('delivery.0.status', $response->decodeResponseJson('errors'));
    }

    /**
     * @test
     */
    public function deliverySetting_not_set_in_db()
    {
        $entry_data = [
            'delivery' => [
                [
                    'type' => DeliveryType::PERSONAL,
                    'cost' => DeliveryType::ZERO_DELIVERY_COST,
                    'status' => DeliveryStatus::INACTIVE,
                ]
            ],
        ];
        $response = $this->sendStoreDeliverySettingsRequest($entry_data)->assertStatus(302);

        $this->assertDatabaseMissing('delivery', [
            'merchant_id' => $this->merchant->id,
        ]);
    }

    /**
     * @test
     */
    public function deliverySetting_set_in_db()
    {
        $entry_data = [
            'delivery' => [
                [
                    'type' => DeliveryType::PERSONAL,
                    'cost' => DeliveryType::ZERO_DELIVERY_COST,
                    'status' => DeliveryStatus::ACTIVE,
                ],
                [
                    'type' => DeliveryType::PERSONAL,
                    'cost' => null,
                    'status' => DeliveryStatus::ACTIVE,
                ]
            ],
        ];
        $response = $this->sendStoreDeliverySettingsRequest($entry_data)->assertStatus(302);

        $this->assertDatabaseHas('delivery', [
            'merchant_id' => $this->merchant->id,
            'type' => DeliveryType::PERSONAL,
            'cost' => DeliveryType::ZERO_DELIVERY_COST,
        ]);
    }

    /**
     * @test
     */
    public function deliverySetting_redirect_to_shop_settings()
    {
        $incoming_parameters = [
            'expiry_after' => 123465,
        ];
        $response = $this->postJson(route('shop.shop-settings'), $incoming_parameters)
            ->assertRedirect(route('shop.index'))
            ->assertSessionHas('success');
    }

    /**
     * @return \Illuminate\Testing\TestResponse
     */
    protected function sendStoreDeliverySettingsRequest(array $entry_data): \Illuminate\Testing\TestResponse
    {
        return $this->postJson(route('shop.delivery-settings'), $entry_data);
    }
}



















