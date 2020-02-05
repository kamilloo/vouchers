<?php
declare(strict_types=1);

namespace App\Http\ViewModels;

use App\Managers\DeliveryManager;
use App\Models\Merchant;
use App\Models\Voucher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class TemplateViewModel implements Arrayable
{
    /**
     * @var Merchant
     */
    protected $merchant;
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
        $this->merchant = $merchant;
        $this->voucher = $voucher;
        $this->delivery_manager = $delivery_manager;
    }

    protected function logo(): ?string
    {
        if ($this->merchant->hasShopImages() && $this->merchant->hasActiveLogo())
        {
            return $this->merchant->getLogo();
        }
        return null;
    }

    protected function backgroundImage(): ?string
    {
        if ($this->merchant->hasShopImages() && $this->merchant->hasActiveBackgroundImage())
        {
            return $this->merchant->getBackgroundImage();
        }
        return null;
    }

    protected function welcoming(): ?string
    {
        if ($this->merchant->hasShopStyles())
        {
            return $this->merchant->getWelcoming();
        }
        return null;
    }


    protected function background(): ?string
    {
        if ($this->merchant->hasShopStyles())
        {
            return $this->merchant->getBackground();
        }
        return null;
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
        return [
            'custom_logo' => $this->logo(),
            'custom_background_image' => $this->backgroundImage(),
            'custom_welcoming' => $this->welcoming(),
            'custom_background' => $this->background(),
            'vouchers' => $this->vouchers(),
            'merchant' => $this->merchant,
            'delivery_options' => $this->delivery(),
            'voucher_presenters' => $this->presenters()
        ];
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
