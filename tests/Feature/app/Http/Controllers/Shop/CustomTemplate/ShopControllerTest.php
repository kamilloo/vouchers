<?php

namespace Tests\Feature\App\Http\Controllers\Shop\CustomTemplate;

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
     * @var UploadedFile
     */
    private $file;
    /**
     * @var \Illuminate\Http\Testing\FileFactory
     */
    private $file_factory;

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
        $this->file_factory = UploadedFile::fake();
        $this->file = $this->file_factory->image('png');
        $this->createUserAndBe();
        $this->merchant = $this->user->merchant()->save(factory(Merchant::class)->make());
    }

    /**
     * @test
     */
    public function customTemplate_validation_exception()
    {
        $response = $this->postJson(route('shop.custom-template'),[
            'background_color' => 'no_color',
            'welcoming' => false
        ])
            ->assertStatus(422);

        $this->assertArrayHasKey('background_color', $response->decodeResponseJson('errors'));
        $this->assertArrayHasKey('welcoming', $response->decodeResponseJson('errors'));
    }

    /**
     * @test
     */
    public function customTemplate_change_template_on_db()
    {
        $response = $this->postJson(route('shop.custom-template'),[
            'background_color' => BackgroundColorType::WHITE,
            'welcoming' => 'welcoming'
        ]);

        $this->assertDatabaseHas('shop_styles', [
            'merchant_id' => $this->merchant->id,
            'background_color' => BackgroundColorType::WHITE,
            'welcoming' => 'welcoming'
        ]);
    }


    /**
     * @test
     */
    public function customTemplate_update_existing_shop_styles_on_db()
    {
        ShopStyle::whereRaw('1=1')->delete();
        $this->shop_style = factory(ShopStyle::class)->create([
            'merchant_id' => $this->merchant->id
        ]);
        $response = $this->postJson(route('shop.custom-template'),[
            'background_color' => BackgroundColorType::WHITE,
            'welcoming' => 'welcoming'
        ]);
        $this->assertSame(1, ShopStyle::count());
    }


    /**
     * @test
     */
    public function customTemplate_redirect_to_shop_settings()
    {
        $response = $this->postJson(route('shop.custom-template'))
            ->assertRedirect(route('shop.index'))
            ->assertSessionHas('success');
    }
}



















