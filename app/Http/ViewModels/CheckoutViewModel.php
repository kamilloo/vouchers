<?php
declare(strict_types=1);

namespace App\Http\ViewModels;

use App\Managers\DeliveryManager;
use App\Models\Merchant;
use App\Models\Voucher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class CheckoutViewModel extends TemplateViewModel
{
    /**
     * @var Voucher
     */
    protected $voucher;
    /**
     * @var DeliveryManager
     */
    protected $delivery_manager;

    public function __construct(Merchant $merchant, Voucher $voucher, DeliveryManager $delivery_manager)
    {
        parent::__construct($merchant);
        $this->voucher = $voucher;
        $this->delivery_manager = $delivery_manager;
    }

    protected function vouchers():Collection
    {
        return $this->voucher->forMerchant($this->merchant)->get();
    }

    protected function delivery(): array
    {
        return $this->delivery_manager->getForMerchant($this->merchant);
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'vouchers' => $this->vouchers(),
            'delivery_options' => $this->delivery(),
            'voucher_presenters' => $this->presenters()
        ]);
    }

    protected function presenters(): Collection
    {
        return $this->vouchers()->map($this->toPresenter());
    }

    /**
     * @return \Closure
     */
    protected function toPresenter(): \Closure
    {
        return function ($voucher) {
            return $voucher->presenter;
        };
    }
}
