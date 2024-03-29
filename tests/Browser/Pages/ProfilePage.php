<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class ProfilePage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return 'profile';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertSee('ProfileController');
        $browser->assertSee('Imię');
        $browser->assertSee('Nazwisko');
        $browser->assertSee('Adres');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
