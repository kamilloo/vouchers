<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Models\Service;
use App\Models\ServicePackage;
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
        $vouchers = Voucher::Mine()->paginate();
        return view('vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        $services = Service::toMe()->get();
        $service_packages = ServicePackage::toMe()->get();

        return view('vouchers.create', compact('services', 'service_packages'));
    }

    public function store(VoucherStore $request, Guard $guard, VoucherRepository $repository)
    {
        $voucher = $repository->create($request, $guard->user());

        return redirect(route('vouchers.index'))->with('success', __('Your Voucher was stored!'));
    }

    public function edit(Voucher $voucher)
    {
        $services = Service::toMe()->get();
        $service_packages = ServicePackage::toMe()->get();
        return view('vouchers.edit', compact('voucher', 'services', 'service_packages'));
    }

    public function update(VoucherUpdate $request, Voucher $voucher, VoucherRepository $repository)
    {
        $repository->update($request, $voucher);

        return redirect(route('vouchers.index'))->with('success', __('Your Voucher was updated!'));
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect(route('vouchers.index'))->with('info', __('Your Voucher was deleted'));
    }
}
