<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Models\Order;
use App\Models\UserProfile;
use App\Models\Voucher;
use Domain\Vouchers\VoucherRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class VoucherOrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class);
    }

    public function download(Order $order)
    {
        // download
    }

    public function send(Order $order)
    {
        //send
    }

    public function push(Order $order)
    {
        //push
    }
}
