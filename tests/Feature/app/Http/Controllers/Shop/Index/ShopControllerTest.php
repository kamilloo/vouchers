<?php

namespace Tests\Feature\App\Http\Controllers\Shop\Index;

use App\Models\Enums\VoucherType;
use App\Models\Merchant;
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

    protected function setUp(): void
    {
        parent::setUp();
        $this->file_factory = UploadedFile::fake();
        $this->file = $this->file_factory->image('png');
        $this->createUserAndBe();
        $this->user->merchant;
    }

    /**
     * @test
     */
    public function index_get_template_list()
    {
        $response = $this->get(route('shop.index'))
            ->assertViewHas(['templates', 'my_template']);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function changeTemplate_validation_exception()
    {
        $template = factory(Template::class)->create();
        $fake_template_id = $template->id;
        $template->delete();
        $response = $this->postJson(route('shop.change-template'),[
            'template_id' => $fake_template_id
        ])
        ->assertStatus(422);

        $this->assertArrayHasKey('template_id', $response->decodeResponseJson('errors'));
    }

    /**
     * @test
     */
    public function changeTemplate_change_template_on_db()
    {
        $template = factory(Template::class)->create();

        $response = $this->postJson(route('shop.change-template'),[
            'template_id' => $template->id
        ]);

        $this->assertDatabaseHas('merchants', [
            'user_id' => $this->user->id,
            'template_id' => $template->id
        ]);

    }


    /**
     * @test
     */
    public function changeTemplate_redirect_to_shop_settings()
    {
        $template = factory(Template::class)->create();

        $response = $this->postJson(route('shop.change-template'),[
            'template_id' => $template->id
        ])->assertRedirect(route('shop.index'))->assertSessionHas('success');

    }
}



















