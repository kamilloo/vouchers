<?php

namespace Domain\Services;

use App\Contractors\IVoucherRepository;
use App\Http\Requests\ServiceCategoryStoreRequest;
use App\Http\Requests\VoucherStore;
use App\Models\Enums\CategoryStatus;
use App\Models\Merchant;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Connection;
use Illuminate\Http\UploadedFile;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
use Throwable;

class ServiceCategoryRepository
{
    /**
     * @var ServiceCategory
     */
    protected $service_category;
    /**
     * @var Connection
     */
    private $db;
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Connection $db, Logger $logger, ServiceCategory $service_category)
    {
        $this->db = $db;
        $this->logger = $logger;
        $this->service_category = $service_category;
    }

    public function create(ServiceCategoryStoreRequest $request, Merchant $merchant): ServiceCategory
    {
        try{
            return $this->db->transaction(function () use ($request, $merchant){
                $attributes = [
                    'title' => $request->getTitleParam(),
                    'description' => $request->getDescriptionParam(),
                    'active' => $request->getActiveParam(),
                ];

                $service_category = $merchant->serviceCategories()->create($attributes);
                return $service_category;
            });
        }catch (Throwable $exception){

            $this->logger->error($exception->getMessage(), [
               'code' => $exception->getCode(),
                'trace' => $exception->getTraceAsString(),
            ]);
            return new ServiceCategory();
        }
    }

    public function createFromTitle(string $title, Merchant $merchant)
    {
        $service_category = $merchant->serviceCategories()->create([
            'title' => $title,
            'active' => CategoryStatus::ACTIVE
        ]);
        return $service_category;
    }

    public function findMineById($id): ?ServiceCategory
    {
        return $this->service_category
            ->toMe()
            ->find($id);
    }

    public function findMineByTitle(string $title): ?ServiceCategory
    {
        return $this->service_category
            ->toMe()
            ->where('title', $title)
            ->first();
    }
}

