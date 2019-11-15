<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\ServiceCategoryStoreRequest;
use App\Http\Requests\ServiceCategoryUpdateRequest;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\UserProfile;
use App\Models\Voucher;
use Domain\Services\ServiceCategoryRepository;
use Domain\Vouchers\VoucherRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Service::class);
    }

    public function index(Guard $guard)
    {
        $services = Service::toMe()->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(ServiceCategoryStoreRequest $request, Guard $guard, ServiceCategoryRepository $repository)
    {
        $service = $repository->create($request, $guard->user()->merchant()->first());

        return redirect(route('service-categories.index'))->with('success', 'Your Category was stored!');
    }

    public function edit(ServiceCategory $service_category)
    {
        return view('service-categories.edit', compact('service_category'));
    }

    public function update(ServiceCategoryUpdateRequest $request, ServiceCategory $service_category)
    {
        $voucher_attributes = $request->only([
            'title',
            'description',
            'active',
        ]);
        $service_category->update($voucher_attributes);

        return redirect(route('service-categories.index'))->with('success', 'Your profile was updated!');
    }

    public function destroy(ServiceCategory $service_category)
    {
        $service_category->delete();
        return redirect(route('service-categories.index'))->with('info', 'Your Voucher was deleted');
    }
}
