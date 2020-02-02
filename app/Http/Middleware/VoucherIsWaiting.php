<?php

namespace App\Http\Middleware;

use App\Models\Merchant;
use App\Models\Order;
use Closure;

class VoucherIsWaiting
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
        if ($order->isCompleted())
        {
            return $next($request);
        }
        return back()->with(['error' => __('Action forbidden')]);
    }

    protected function getOrder($request): Order
    {
        return $request->order;
    }
}
