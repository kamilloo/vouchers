<?php

namespace Tests\Feature\App\Http\Controllers\Shop\ShopSettings;

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
        $response = $this->postJson(route('shop.shop-settings'),[
            'expiry_after' => false,
            'delivery_cost' => false,
        ])->assertStatus(422);

        $this->assertArrayHasKey('expiry_after', $response->decodeResponseJson('errors'));
        $this->assertArrayHasKey('delivery_cost', $response->decodeResponseJson('errors'));
    }

    /**
     * @test
     */
    public function gatewaySetting_set_in_db()
    {
        $incoming_parameters = [
            'expiry_after' => 123465,
            'delivery_cost' => 123132.11,
        ];
        $response = $this->postJson(route('shop.shop-settings'), $incoming_parameters);

        $this->assertDatabaseHas('shop_settings', array_merge($incoming_parameters, [
            'merchant_id' => $this->merchant->id,
        ]));
    }

    /**
     * @test
     */
    public function gatewaySetting_redirect_to_shop_settings()
    {
        $incoming_parameters = [
            'expiry_after' => 123465,
            'delivery_cost' => 123132.11,
        ];
        $response = $this->postJson(route('shop.shop-settings'), $incoming_parameters)
            ->assertRedirect(route('shop.index'))
            ->assertSessionHas('success');
    }
}



















