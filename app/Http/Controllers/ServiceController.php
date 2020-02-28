<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\ServiceCategoryStoreRequest;
use App\Http\Requests\ServiceCategoryUpdateRequest;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\UserProfile;
use App\Models\Voucher;
use Domain\Services\ServiceCategoryRepository;
use Domain\Services\ServiceRepository;
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
        $services = Service::toMe()->paginate();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        $service_categories = ServiceCategory::toMe()->get();
        return view('services.create', compact('service_categories'));
    }

    public function store(ServiceStoreRequest $request, Guard $guard, ServiceRepository $repository)
    {
        $service = $repository->create($request, $guard->user()->merchant()->first());

        return redirect(route('services.index'))->with('success', __('Your Service was stored!'));
    }

    public function edit(Service $service)
    {
        $service_categories = ServiceCategory::toMe()->get();
        return view('services.edit', compact('service', 'service_categories'));
    }

    public function update(ServiceUpdateRequest $request, Service $service, ServiceRepository $repository)
    {
        $repository->update($request, $service);
        return redirect(route('services.index'))->with('success', __('Your Service was updated!'));
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect(route('services.index'))->with('info', __('Your Service was deleted'));
    }
}
