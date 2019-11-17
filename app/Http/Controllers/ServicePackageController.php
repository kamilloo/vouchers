<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\ServiceCategoryStoreRequest;
use App\Http\Requests\ServiceCategoryUpdateRequest;
use App\Http\Requests\ServicePackageStoreRequest;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServicePackage;
use App\Models\UserProfile;
use App\Models\Voucher;
use Domain\Services\ServiceCategoryRepository;
use Domain\Services\ServicePackageRepository;
use Domain\Services\ServiceRepository;
use Domain\Vouchers\VoucherRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class ServicePackageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ServicePackage::class);
    }

    public function index(Guard $guard)
    {
        $service_packages = ServicePackage::toMe()->get();
        return view('service-packages.index', compact('service_packages'));
    }

    public function create()
    {
        return view('service-packages.create');
    }

    public function store(ServicePackageStoreRequest $request, Guard $guard, ServicePackageRepository $repository)
    {
        $service = $repository->create($request, $guard->user()->merchant()->first());

        return redirect(route('service-packages.index'))->with('success', 'Your Package was stored!');
    }

    public function edit(ServicePackage $service_package)
    {
        return view('service-packages.edit', compact('service_package'));
    }

    public function update(ServicePackageStoreRequest $request, ServicePackage $service_package, ServicePackageRepository $repository)
    {
        $repository->update($request, $service_package);
        return redirect(route('service-packages.index'))->with('success', 'Your service was updated!');
    }

    public function destroy(ServicePackage $service_package)
    {
        $service_package->delete();
        return redirect(route('service-packages.index'))->with('info', 'Your Service was deleted');
    }
}
