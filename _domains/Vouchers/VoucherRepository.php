<?php

namespace Domain\Vouchers;

use App\Contractors\IVoucherRepository;
use App\Exceptions\VoucherUsed;
use App\Http\Requests\VoucherStore;
use App\Http\Requests\VoucherUpdate;
use App\Models\Enums\VoucherType;
use App\Models\Merchant;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Connection;
use Illuminate\Http\UploadedFile;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
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

                $voucher_attributes = $this->getBaseVoucherParams($request);

                /**
                 * @var $voucher Voucher
                 */
                $voucher = $user->vouchers()->make($voucher_attributes);
                $voucher->merchant()->associate($user->merchant);

                $this->associateProductToVoucher($voucher, $request);
                $voucher->save();
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


    public function update(VoucherUpdate $request, Voucher $voucher): bool
    {
        try{
            return $this->db->transaction(function () use ($request, $voucher){

                $voucher_attributes = $this->getBaseVoucherParams($request);

                $voucher->update($voucher_attributes);

                $this->associateProductToVoucher($voucher, $request);

                return $voucher->save();

            });
        }catch (Throwable $exception){

            $this->logger->error($exception->getMessage(), [
                'code' => $exception->getCode(),
                'trace' => $exception->getTraceAsString(),
            ]);
            return false;
        }
    }

    protected function replaceLogo(UploadedFile $file)
    {
        return $file->storePublicly('public/vouchers');
    }

    /**
     * @param Voucher $voucher
     * @param $product
     */
    protected function associateProductToVoucher(Voucher $voucher, VoucherStore $request): void
    {

        $voucher_type = $request->getTypeParam();
        if ($voucher_type == VoucherType::QUOTE || empty($product_id = $request->getProductIdParam()))
        {
            return;
        }

        if ($voucher_type == VoucherType::SERVICE)
        {
            $product = $voucher->merchant->services()->findOrFail($product_id);
        }
        if ($voucher_type == VoucherType::SERVICE_PACKAGE)
        {
            $product = $voucher->merchant->servicePackages()->findOrFail($product_id);
        }

        $voucher->product()->associate($product);
        return;
    }

    /**
     * @param VoucherStore $request
     *
     * @return array
     */
    function getBaseVoucherParams(VoucherStore $request): array
    {
        $voucher_attributes = [
            'title' => $request->getTitleParam(),
            'type' => $request->getTypeParam(),
            'price' => $request->getPriceParam(),
        ];
        $file = $request->file('file-name');
        if (!empty($file))
        {
            $logo = $this->replaceLogo($file);
            Arr::set($voucher_attributes, 'file', $logo);
        }
        return $voucher_attributes;
    }
}

