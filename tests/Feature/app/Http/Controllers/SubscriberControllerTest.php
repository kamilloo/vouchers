<?php
declare(strict_types=1);

namespace Tests\Feature\App\Http;

use App\Models\Subscriber;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriberControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function subscriber_require_passing_email()
    {
        $response = $this->sendAddSubscribeRequest([]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors('email');
    }

    /**
     * @test
     */
    public function subscribe_return_success_message()
    {
        $email = 'email@email.com';
        $response = $this->sendAddSubscribeRequest(compact('email'));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function subscriber_was_added_to_subscriber_list()
    {
        $email = 'email@email.com';
        $response = $this->sendAddSubscribeRequest(compact('email'));

        $this->assertDatabaseHas('subscribers', [
            'email' => $email
        ]);
    }


    /**
     * @test
     */
    public function subscriber_already_exist_in_subscriber_list()
    {
        $email = 'email@email.com';
        $existing_subscriber = $this->createSubscriber(compact('email'));
        $response = $this->sendAddSubscribeRequest(compact('email'));

        $this->assertDatabaseHas('subscribers', [
            'email' => $email
        ]);
        $response->assertStatus(Response::HTTP_FAILED_DEPENDENCY);

        $subscriber_amount = Subscriber::where('email', $email)->count();
        $this->assertDatabaseHas('subscribers', [
            'email' => $email,
            'id' => $existing_subscriber->id,
        ]);
        $this->assertSame(1, $subscriber_amount);
    }

    /**
     * @param array $entry_data
     *
     * @return \Illuminate\Testing\TestResponse
     */
    protected function sendAddSubscribeRequest(array $entry_data): \Illuminate\Testing\TestResponse
    {
        return $this->postJson(route('subscribe'), $entry_data);
    }

    private function createSubscriber(array $attributes):Subscriber
    {
        return factory(Subscriber::class)->create($attributes);
    }
}
