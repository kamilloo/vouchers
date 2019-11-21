<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Models\Payment;
use App\Models\UserProfile;
use App\Models\Voucher;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Voucher::class);
    }

    public function index(Guard $guard)
    {
        $payments = Payment::toMe()->get();
        return view('payments.index', compact('payments'));
    }
}
