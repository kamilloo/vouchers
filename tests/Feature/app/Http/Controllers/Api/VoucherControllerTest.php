<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Models\Enums\PaymentStatus;
use App\Models\Enums\VoucherType;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class VoucherControllerTest extends TestCase
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
        $this->createUserAndBeFromApi();

    }

    /**
     * @test
     */
    public function get_not_found_voucher()
    {
        $order = factory(Order::class)->create();

        $response = $this->getJson(route('api-voucher-get', $order->qr_code));

        $response->assertStatus(404);
        $this->assertContains('No query results for model', $response->decodeResponseJson('message'));
    }

    /**
     * @test
     */
    public function get_order_founded_be_me()
    {
        $order = factory(Order::class)->make();
        $this->user->merchant->orders()->save($order);

        $response = $this->getJson(route('api-voucher-get', $order->qr_code));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function get_response_with_order()
    {
        $order = factory(Order::class)->make();
        $this->user->merchant->orders()->save($order);

        $response = $this->getJson(route('api-voucher-get', $order->qr_code));
        $response->assertJsonStructure([
            'data' => [
                'delivery',
                'full_name',
                'phone',
                'email',
                'qr_code',
                'expired_at',
                'status',
                'paid',
                'used_at',
                'voucher' => [
                    'title',
                    'price',
                    'type',
                ],
            ]
        ]);
    }


    /**
     * @test
     */
    public function get_response_with_product()
    {
        $order = $this->createOrderForProduct();

        $response = $this->getJson(route('api-voucher-get', $order->qr_code));
        $response->assertJsonStructure([
            'data' => [
                'voucher' => [
                    'title',
                    'price',
                    'type',
                    'product' => [
                        'title',
                        'description'
                    ]
                ],
            ]
        ]);
    }

    /**
     * @test
     */
    public function pay_response_with_payment()
    {

        $order = $this->createOrderForPayment();
        $payment = $this->createPayment($order);

        $response = $this->postJson(route('api-voucher-pay', $order->qr_code))->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'delivery',
                'full_name',
                'phone',
                'email',
                'qr_code',
                'expired_at',
                'status',
                'paid',
                'used_at',
                'voucher' => [
                    'title',
                    'price',
                    'type',
                ],
            ]
        ]);
    }

    /**
     * @test
     */
    public function pay_set_used_attribute()
    {
        $order = $this->createOrderForPayment();
        $payment = $this->createPayment($order);

        $now = Carbon::parse('2010-10-10');
        Carbon::setTestNow($now);

        $response = $this->postJson(route('api-voucher-pay', $order->qr_code))->assertOk();

        $this->assertDatabaseHas('orders', [
           'id' => $order->id,
           'used_at' =>  $now
        ]);

        $this->assertSame($now->toIso8601String(), $response->decodeResponseJson('data')['used_at']);

    }

    /**
     * @test
     */
    public function pay_reject_because_not_approved_payment_found()
    {
        $order = $this->createOrderForPayment([
            'paid' => PaymentStatus::WAITING_FOR_PAY
        ]);
        $response = $this->postJson(route('api-voucher-pay', $order->qr_code))->assertStatus(424);
        $this->assertSame('Voucher not paid', $response->decodeResponseJson('message'));
    }

    /**
     * @test
     */
    public function pay_reject_because_voucher_expired()
    {
        $expired_at = Carbon::now()->subDays(1);
        $used_at = null;
        $order = $this->createOrderForPayment(compact('expired_at', 'used_at'));
        $payment = $this->createPayment($order);

        $response = $this->postJson(route('api-voucher-pay', $order->qr_code))->assertStatus(424);
        $this->assertSame('Voucher expired', $response->decodeResponseJson('message'));
    }


    /**
     * @test
     */
    public function pay_reject_because_voucher_used()
    {
        $used_at = Carbon::now()->subDays(1);
        $expired_at = null;
        $order = $this->createOrderForPayment(compact('used_at','expired_at'));
        $payment = $this->createPayment($order);

        $response = $this->postJson(route('api-voucher-pay', $order->qr_code))->assertStatus(424);
        $this->assertSame('Voucher used', $response->decodeResponseJson('message'));
    }

    /**
     * @return Order
     */
    protected function createOrderForProduct(): Order
    {
        $service = $this->createService();
        $voucher = $this->makeVoucher();
        $voucher->product()->associate($service);
        $voucher->save();
        $order = $this->makeOrder();
        $order->voucher()->associate($voucher);

        $this->user->merchant->orders()->save($order);

        return $order;
    }


    /**
     * @return Order
     */
    protected function createOrderForPayment(array $attribute = []): Order
    {
        $voucher = $this->makeVoucher();
        $voucher->save();
        $order = $this->makeOrder($attribute);
        $order->voucher()->associate($voucher);

        $this->user->merchant->orders()->save($order);

        return $order;
    }

    /**
     * @return mixed
     */
    protected function createService(array $attribute = []): Service
    {
        return factory(Service::class)->create($attribute);
    }

    /**
     * @return Order
     */
    protected function makeOrder(array $attribute = []): Order
    {
        return factory(Order::class)->make($attribute);
    }

    private function makeVoucher(array $attribute = []): Voucher
    {
        return factory(Voucher::class)->make($attribute);
    }

    private function makePayment(array $attribute = []): Payment
    {
        return factory(Payment::class)->make($attribute);
    }

    private function createPayment(Order $order, array $attribute = []): Payment
    {
        $payment = $this->makePayment($attribute);
        $payment->order()->associate($order);
        $payment->save();
        return  $payment;
    }

}
