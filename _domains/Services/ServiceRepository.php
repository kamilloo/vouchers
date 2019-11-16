<?php

namespace Domain\Services;

use App\Contractors\IVoucherRepository;
use App\Http\Requests\ServiceCategoryStoreRequest;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\VoucherStore;
use App\Models\Merchant;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
use Throwable;

class ServiceRepository
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

    public function create(ServiceStoreRequest $request, Merchant $merchant): Service
    {
        try{
            return $this->db->transaction(function () use ($request, $merchant){
                $attributes = [
                    'title' => $request->getTitleParam(),
                    'description' => $request->getDescriptionParam(),
                    'active' => $request->getActiveParam(),
                    'price' => $request->getPriceParam(),
                ];

                $service = $merchant->services()->create($attributes);

                $this->assignCategory($service, $request, $merchant);

                return $service;
            });
        }catch (Throwable $exception){

            $this->logger->error($exception->getMessage(), [
               'code' => $exception->getCode(),
                'trace' => $exception->getTraceAsString(),
            ]);
            return new Service();
        }


    }

    protected function replaceLogo(UploadedFile $file)
    {
        return $file->storePublicly('public/vouchers');
    }

    private function assignCategory(Service $service, ServiceStoreRequest $request, Merchant $merchant)
    {
        $service_category = $this->service_category_repository
            ->findMineById($request->getCategoryIdParam());

        if ($service_category)
        {
            $service->categories()->attach($service_category);
            return;
        }

        if ($new_category_title = $request->getCategoryTitleParam())
        {
            $service_category = $this->service_category_repository->createFromTitle($new_category_title, $merchant);
            $service->categories()->attach($service_category);
        }
        return;
    }
}

