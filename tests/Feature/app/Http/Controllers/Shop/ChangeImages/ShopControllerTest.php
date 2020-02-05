<?php

namespace Tests\Feature\App\Http\Controllers\Shop\ChangeImages;

use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\ShopImage;
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
     * @var false|\Illuminate\Database\Eloquent\Model
     */
    private $merchant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->file_factory = UploadedFile::fake();
        $this->file = $this->file_factory->image('png');
        $this->createUserAndBe();
        $this->merchant = $this->user->merchant;

    }

    /**
     * @test
     */
    public function changeImages_validation_exception()
    {
        $template = factory(Template::class)->create();
        $template->delete();
        $response = $this->postJson(route('shop.change-images'),[
            'logo_enabled' => 'no_Valid_boolean',
            'front_enabled' => 'no_valid_boolean',
            'logo' => 'no_file',
            'front' => 'no_file'
        ])
        ->assertStatus(422);

        $this->assertArrayHasKey('logo_enabled', $response->decodeResponseJson('errors'));
        $this->assertArrayHasKey('front_enabled', $response->decodeResponseJson('errors'));
        $this->assertArrayHasKey('logo', $response->decodeResponseJson('errors'));
        $this->assertArrayHasKey('front', $response->decodeResponseJson('errors'));
    }

    /**
     * @test
     */
    public function changeImages_change_template_on_db()
    {
        $response = $this->post(route('shop.change-images'),[
            'logo_enabled' => true,
            'front_enabled' => true,
        ]);

        $this->assertDatabaseHas('shop_images', [
            'merchant_id' => $this->merchant->id,
            'logo_enabled' => false,
            'front_enabled' => false,
            'logo' => null,
            'front' => null,
        ]);
    }


    /**
     * @test
     */
    public function changeImages_update_existing_shop_images_on_db()
    {
        ShopImage::whereRaw('1=1')->delete();
        $this->shop_images = factory(ShopImage::class)->create([
            'merchant_id' => $this->merchant->id,
        ]);
        $response = $this->post(route('shop.change-images'),[
            'logo_enabled' => true,
            'front_enabled' => true,
        ]);

        $this->assertSame(1, ShopImage::count());
    }

    /**
     * @test
     */
    public function changeImages_store_logo_images()
    {
        $response = $this->post(route('shop.change-images'),[
            'logo_enabled' => true,
            'front_enabled' => true,
            'logo' => $this->file
        ]);

        $logo_file_name = $this->merchant->shopImages()->first()->logo;
        Storage::assertExists($logo_file_name);

    }

    /**
     * @test
     */
    public function changeImages_store_front_images()
    {
        $response = $this->post(route('shop.change-images'),[
            'logo_enabled' => true,
            'front_enabled' => true,
            'front' => $this->file
        ]);

        $file_name = $this->merchant->shopImages()->first()->front;
        Storage::assertExists($file_name);

    }

    /**
     * @test
     */
    public function changeImages_not_tough_logo_images()
    {
        $fake_image_url = 'fake_image_url';
        $this->shop_images = factory(ShopImage::class)->create([
            'merchant_id' => $this->merchant->id,
            'logo' => $fake_image_url
        ]);
        $response = $this->post(route('shop.change-images'),[
            'logo_enabled' => true,
            'front_enabled' => true,
        ]);

        $this->assertDatabaseHas('shop_images',[
            'merchant_id' => $this->merchant->id,
            'logo_enabled' => true,
            'front_enabled' => true,
            'logo' => $fake_image_url
        ]);

    }

    /**
     * @test
     */
    public function changeImages_not_tough_front_images()
    {
        $fake_image_url = 'fake_image_url';
        $this->shop_images = factory(ShopImage::class)->create([
            'merchant_id' => $this->merchant->id,
            'front' => $fake_image_url
        ]);
        $response = $this->post(route('shop.change-images'),[
            'logo_enabled' => true,
            'front_enabled' => true,
        ]);

        $this->assertDatabaseHas('shop_images',[
            'merchant_id' => $this->merchant->id,
            'logo_enabled' => true,
            'front_enabled' => true,
            'front' => $fake_image_url
        ]);
    }

    /**
     * @test
     */
    public function changeImages_redirect_to_shop_settings()
    {
        $template = factory(Template::class)->create();

        $response = $this->post(route('shop.change-images'),[
            'logo_enabled' => true,
            'front_enabled' => true,
        ])->assertRedirect(route('shop.index'))->assertSessionHas('success');

    }
}



















