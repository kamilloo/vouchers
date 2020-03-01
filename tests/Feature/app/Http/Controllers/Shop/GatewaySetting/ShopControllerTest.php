<?php

namespace Tests\Feature\App\Http\Controllers\Shop\GatewaySetting;

use App\Models\Enums\BackgroundColorType;
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


    public function entryGatewayProviderData():iterable
    {
        yield [[
            'payment_gateway_enabled' => false,
        ]];

        yield [[
            'payment_gateway_enabled' => true,
            'merchant_id' => 123465,
            'pos_id' => 123456,
            'crc' => 'crc',
            'sandbox' => true
        ]];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->createUserAndBe();
        $this->merchant = $this->user->merchant;
    }

    /**
     * @test
     */
    public function gatewaySetting_validation_exception()
    {
        $response = $this->postJson(route('shop.gateway-settings'),[
            'payment_gateway_enabled' => 'fake_merchant_id',
            'merchant_id' => 'fake_merchant_id',
            'pos_id' => 'fake_pos_id',
            'crc' => false,
            'sandbox' => 'no_boolean'
        ])
            ->assertStatus(422);

        $this->assertArrayHasKey('merchant_id', $response->decodeResponseJson('errors'));
        $this->assertArrayHasKey('pos_id', $response->decodeResponseJson('errors'));
        $this->assertArrayHasKey('crc', $response->decodeResponseJson('errors'));
        $this->assertArrayHasKey('sandbox', $response->decodeResponseJson('errors'));
    }

    /**
     * @test
     * @dataProvider entryGatewayProviderData
     */
    public function gatewaySetting_set_in_db(array $incoming_parameters)
    {

        $response = $this->postJson(route('shop.gateway-settings'), $incoming_parameters);

        $this->assertDatabaseHas('merchants', array_merge($incoming_parameters, [
            'id' => $this->merchant->id,
        ]));
    }

    /**
     * @test
     * @dataProvider entryGatewayProviderData
     */
    public function gatewaySetting_redirect_to_shop_settings(array $incoming_parameters)
    {

        $response = $this->postJson(route('shop.gateway-settings'), $incoming_parameters)
            ->assertRedirect(route('shop.index'))
            ->assertSessionHas('success');
    }
}



















