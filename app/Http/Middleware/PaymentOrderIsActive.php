<?php

namespace App\Http\Middleware;

use App\Models\Merchant;
use App\Models\Order;
use Closure;

class PaymentOrderIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $order = $this->getOrder($request);
        if ($order->isActive())
        {
            return $next($request);
        }
        return redirect()->away($order->merchant->presenter->shopLink());

    }

    protected function getOrder($request): Order
    {
        return $request->payment->order;
    }
}
