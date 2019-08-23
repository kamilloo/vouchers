<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Models\UserProfile;
use App\Models\Voucher;
use Domain\Vouchers\VoucherRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Voucher::class);
    }

    public function index(Guard $guard)
    {
        $vouchers = Voucher::Mine()->get();
        return view('vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('vouchers.create');
    }

    public function store(VoucherStore $request, Guard $guard, VoucherRepository $repository)
    {
        $voucher_attributes = $request->only([
            'title',
            'type',
            'price',
            'service'
        ]);
        $user = $guard->user();

        $voucher = $user->vouchers()->create($voucher_attributes);
        $user->merchant->vouchers()->attach($voucher->id);
        return redirect(route('vouchers.index'))->with('success', 'Your Voucher was updated!');
    }

    public function edit(Voucher $voucher)
    {
        return view('vouchers.edit', compact('voucher'));
    }

    public function update(VoucherUpdate $request, Voucher $voucher, FilesystemManager $file_manager)
    {
        $voucher_attributes = $request->only([
            'title',
            'type',
            'price',
            'service'
        ]);
        $voucher->update($voucher_attributes);

        return redirect(route('vouchers.index'))->with('success', 'Your profile was updated!');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect(route('vouchers.index'))->with('info', 'Your Voucher was deleted');
    }
}
