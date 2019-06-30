<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\Browser\Pages\ProfilePage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    private $user;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('SPRZEDAJEMY')
                    ->assertSee('Oferujemy bony upomnikowe');

        });
    }

    /**
     * @test
     */
    public function profile_page_render()
    {
        $this->user = factory(User::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visit(new ProfilePage);
        });
    }
}
