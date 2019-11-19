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
        $services = Service::toMe()->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(ServiceStoreRequest $request, Guard $guard, ServiceRepository $repository)
    {
        $service = $repository->create($request, $guard->user()->merchant()->first());

        return redirect(route('services.index'))->with('success', 'Your Service was stored!');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(ServiceUpdateRequest $request, Service $service, ServiceRepository $repository)
    {
        $repository->update($request, $service);
        return redirect(route('services.index'))->with('success', 'Your service was updated!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect(route('services.index'))->with('info', 'Your Service was deleted');
    }
}
