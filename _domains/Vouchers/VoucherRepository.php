<?php

namespace Domain\Vouchers;

use App\Contractors\IVoucherRepository;
use App\Http\Requests\VoucherStore;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Connection;
use Illuminate\Log\Logger;
use Throwable;

class VoucherRepository implements IVoucherRepository
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

    public function create(VoucherStore $request, User $user): Voucher
    {
        try{
            return $this->db->transaction(function () use ($request, $user){
                $voucher_attributes = [
                    'title' => $request->getTitleParam(),
                    'type' => $request->getTypeParam(),
                    'price' => $request->getPriceParam(),
                    'service' => $request->getServiceParam()
                ];

                $voucher = $user->vouchers()->create($voucher_attributes);
                $user->merchant->vouchers()->attach($voucher->getKey());
                return $voucher;
            });
        }catch (Throwable $exception){

            $this->logger->error($exception->getMessage(), [
               'code' => $exception->getCode(),
                'trace' => $exception->getTraceAsString(),
            ]);
            return new Voucher();
        }


    }
}
