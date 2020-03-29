<?php
declare(strict_types=1);

namespace Domain\Orders\Services;

use App\Events\OrderWasPlaced;
use App\Http\ContentTypes\Tag;
use App\Http\Requests\Checkout;
use App\Http\Requests\ProfileUpdate;
use App\Models\Client;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;
use Domain\Merchants\Models\Branch;
use Domain\Merchants\Models\Skill;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use App\Models\UserProfile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CheckoutService
{

    /**
     * @var Guard
     */
    protected $guard;
    /**
     * @var Dispatcher
     */
    protected $event_dispatcher;

    public function __construct(Guard $guard, Dispatcher $event_dispatcher)
    {
        $this->guard = $guard;
        $this->event_dispatcher = $event_dispatcher;
    }

    public function proceed(Checkout $request, Merchant $merchant):Order
    {
        $client = Client::create($request->getClientParam());
        $order = $this->makeOrder($request, $merchant);
        $order->client()->associate($client);
        $order->save();
        $this->event_dispatcher->dispatch(new OrderWasPlaced($order));

        return $order;
    }


    /**
     * @param Checkout $request
     * @param Merchant $merchant
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function makeOrder(Checkout $request, Merchant $merchant): Order
    {
        return $merchant->orders()->make([
            'voucher_id' => $request->getVoucherIdParam(),
            'delivery' => $request->getDeliveryParam(),
            'price' => $request->getPriceParam(),
            'first_name' => $request->getFirstNameParam(),
            'last_name' => $request->getLastNameParam(),
            'phone' => $request->getPhoneParam(),
            'email' => $request->getEmailParam(),
        ]);
    }
}
