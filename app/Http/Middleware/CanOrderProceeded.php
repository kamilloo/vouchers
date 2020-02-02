<?php

namespace App\Http\Middleware;

use App\Models\Merchant;
use App\Models\Order;
use Closure;

class CanOrderProceeded
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
        if ($order->isNew())
        {
            return $next($request);
        }
        if ($order->isRejected())
        {
            return redirect()->route('voucher.failed', [
                'order' => $order,
            ])->with(['error' => __('You bought voucher failed.')]);
        }
        if ($order->isWaiting() || $order->isConfirmed() || $order->isSent() || $order->isDelivery() )
        {
            return redirect()->route('payment.recap', [
                'payment' => $order->payment(),
            ])->with(['success' => __('You bought voucher successful.')]);
        }

        return redirect()->away($this->getMerchant($request)->getHomepage());

    }

    /**
     * @return Merchant
     */
    protected function getMerchant($request):Merchant
    {
        return $request->merchant;
    }

    protected function getOrder($request): Order
    {
        return $request->order;
    }
}
