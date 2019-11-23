<?php

namespace Tests\Unit\App\Models;

use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
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

class VoucherTest extends TestCase
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
        $this->voucher = $this->app->make(Voucher::class);
        $this->merchant = factory(Merchant::class)->create();
    }

    /**
     * @test
     */
    public function scopeForMerchant_filter_by_merchant()
    {
        $voucher = factory(Voucher::class)->create();
        $voucher->merchant()->associate($this->merchant);
        $voucher->save();
        $vouchers = $this->voucher->forMerchant($this->merchant)->get();
        $this->assertSame(1, $vouchers->count());
        $this->assertSame($voucher->id, $vouchers[0]->id);
    }

    /**
     * @test
     */
    public function scopeForMerchant_skip_others()
    {
        $voucher = factory(Voucher::class)->create();
        $vouchers = $this->voucher->forMerchant($this->merchant);
        $this->assertSame(0, $vouchers->count());
    }

}
