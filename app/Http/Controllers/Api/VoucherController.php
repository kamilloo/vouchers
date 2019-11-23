<?php

namespace App\Http\Controllers\Api;

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
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class VoucherController extends Controller
{
    public function get($qr_code, Guard $guard)
    {
        $order = Order::toMe()->with(['voucher.product', 'payments', 'payments.transactions'])->byQrCode($qr_code)->firstOrfail();
        return new OrderResource($order);
    }
}
