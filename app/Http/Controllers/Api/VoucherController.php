<?php

namespace App\Http\Controllers\Api;

use App\Events\VoucherWasReleased;
use App\Exceptions\VoucherExpired;
use App\Exceptions\VoucherNotPaid;
use App\Exceptions\VoucherUsed;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\ShopChangeImages;
use App\Http\Requests\ShopChangeTemplate;
use App\Http\Requests\ShopCustomTemplate;
use App\Http\Resources\OrderResource;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\ShopImage;
use App\Models\ShopStyle;
use App\Models\Template;
use App\Models\UserProfile;
use App\Models\Voucher;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class VoucherController extends Controller
{
    public function get($qr_code, Guard $guard)
    {
        $order = Order::toMe()
            ->with(['voucher', 'voucher.product', 'payments'])
            ->byQrCode($qr_code)
            ->firstOrfail();
        return new OrderResource($order);
    }

    public function pay($qr_code, Guard $guard, Dispatcher $event_dispatcher)
    {
        $order = Order::toMe()
            ->with(['voucher', 'voucher.product', 'payments'])
            ->byQrCode($qr_code)
            ->firstOrfail();

        if (! $order->paid()){
            throw new VoucherNotPaid;
        }

        if ($order->expired()){
            throw new VoucherExpired;
        }

        if ($order->isUsed()){
            throw new VoucherUsed;
        }

        $order->pay();

        $event_dispatcher->dispatch(new VoucherWasReleased($order));

        return new OrderResource($order);
    }


}
