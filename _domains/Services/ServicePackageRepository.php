<?php

namespace Domain\Services;

use App\Contractors\IVoucherRepository;
use App\Http\Requests\ServiceCategoryStoreRequest;
use App\Http\Requests\ServicePackageStoreRequest;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Http\Requests\VoucherStore;
use App\Models\Merchant;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServicePackage;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
use Throwable;

class ServicePackageRepository
{
    /**
     * @var ServiceCategoryRepository
     */
    protected $service_category_repository;
    /**
     * @var Connection
     */
    private $db;
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Connection $db, Logger $logger, ServiceCategoryRepository $service_category_repository)
    {
        $this->db = $db;
        $this->logger = $logger;
        $this->service_category_repository = $service_category_repository;
    }

    public function create(ServicePackageStoreRequest $request, Merchant $merchant): Service
    {
        try{
            return $this->db->transaction(function () use ($request, $merchant){
                $attributes = [
                    'title' => $request->getTitleParam(),
                    'description' => $request->getDescriptionParam(),
                    'active' => $request->getActiveParam(),
                    'price' => $request->getPriceParam(),
                ];

                $service_package = $merchant->servicePackages()->create($attributes);

                $this->assignCategory($service_package, $request);

                return $service_package;
            });
        }catch (Throwable $exception){

            $this->logger->error($exception->getMessage(), [
               'code' => $exception->getCode(),
                'trace' => $exception->getTraceAsString(),
            ]);
            return new Service();
        }


    }

    public function update(ServicePackageStoreRequest $request, ServicePackage $service_package)
    {
        $attributes = $request->only([
            'title',
            'description',
            'active',
            'price',
        ]);
        $service_package->update($attributes);

        $this->assignCategory($service_package, $request);

    }

    private function assignCategory(ServicePackage $service_package, ServicePackageStoreRequest $request)
    {
        $service_category = $this->service_category_repository
            ->findMineById($request->getCategoryIdParam());

        if ($service_category)
        {
            $service_package->categories()->sync($service_category);
            return;
        }

        if ($new_category_title = $request->getCategoryTitleParam())
        {
            $service_category = $this->service_category_repository->createFromTitle($new_category_title, $service_package->merchant()->first());
            $service_package->categories()->sync($service_category);
        }
        return;
    }
}

