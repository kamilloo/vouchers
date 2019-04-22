<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractControllerTest extends TestCase
{
    /**
     * @test
     */
    public function welcome_show_contact_form()
    {
        $response = $this->get('/');
        $response->assertSeeTextInOrder([
            'Chcesz wiedzieć więcej, zapraszamy do kontaktu',
            'Get Started'
        ]);
        $response->assertSee('Podaj adres email');
    }

    /**
     * @test
     */
    public function send_email_was_send()
    {
        //msg	0 - Please enter a value
        // Thank you for subscribing
        // is aleady subscribed to list pexels
        // 0- the domainportion of the email address is invalid
        //
        $response = $this->postJson(route('contact.send'));

        $response->assertOk()
            ->assertJson([
                'code' => 'success',
                'msg' => 'Thank you for subscribing',
            ]);
    }

    /**
     * @test
     */
    public function send_email_validation_exception()
    {
        //msg	0 - Please enter a value
        // Thank you for subscribing
        // is aleady subscribed to list pexels
        // 0- the domainportion of the email address is invalid
        //
        $response = $this->postJson(route('contact.send'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => [
                        'Please enter a value',
                    ]
                ]
            ]);
    }

    /**
     * @test
     */
    public function send_email_user_was_redirected()
    {
        //send email
    }
}
