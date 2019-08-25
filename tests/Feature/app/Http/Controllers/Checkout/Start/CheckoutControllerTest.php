<?php

namespace Tests\Feature\App\Http\Controllers\Checkout\Start;

use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\Template;
use App\Models\User;
use App\Models\Voucher;
use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Mockery as m;
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
    /**
     * @var Merchant
     */
    private $merchant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->merchant = factory(Merchant::class)->create();
    }

    /**
     * @test
     */
    public function start_gets_start_view()
    {
        $response = $this->get(route('checkout.start', $this->merchant))
            ->assertViewIs('checkout.start');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function start_gets_only_merchant_vouchers()
    {
        $vouchers = factory(Voucher::class,2)->create();
        $this->voucher = m::mock(Voucher::class);
        $this->voucher->shouldReceive('forMerchant')
            ->once()
            ->andReturnSelf();
        $this->voucher->shouldReceive('get')
            ->once()
            ->andReturn($vouchers);
        $this->app->instance(Voucher::class, $this->voucher);
        $response = $this->get(route('checkout.start', $this->merchant))
            ->assertViewHas('vouchers');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function start_has_merchant_template()
    {
        $template = factory(Template::class,2)->create();
        $template = m::mock(Template::class);
        $template->shouldReceive('forMerchant')
            ->once()
            ->andReturnSelf();
        $template->shouldReceive('get')
            ->once()
            ->andReturn($template);
        $this->app->instance(Voucher::class, $template);
        $response = $this->get(route('checkout.start', $this->merchant))
            ->assertViewHas('template');

        $response->assertStatus(200);
    }

}
