<?php

namespace Domain\Services;

use App\Contractors\IVoucherRepository;
use App\Http\Requests\ServiceCategoryStoreRequest;
use App\Http\Requests\VoucherStore;
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
     * @var Connection
     */
    private $db;
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Connection $db, Logger $logger)
    {
        $this->db = $db;
        $this->logger = $logger;
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

    protected function replaceLogo(UploadedFile $file)
    {
        return $file->storePublicly('public/vouchers');
    }
}

