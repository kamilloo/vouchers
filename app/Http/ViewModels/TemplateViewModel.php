<?php
declare(strict_types=1);

namespace App\Http\ViewModels;

use App\Managers\DeliveryManager;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class TemplateViewModel implements Arrayable
{
    /**
     * @var Merchant
     */
    protected $merchant;

    public function __construct(Merchant $merchant)
    {
        $this->merchant = $merchant;
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
        if ($this->merchant->hasShopStyles() && $this->merchant->hasActiveWelcoming())
        {
            return $this->merchant->getWelcoming();
        }
        return null;
    }


    protected function background(): ?string
    {
        if ($this->merchant->hasShopStyles() && $this->merchant->hasActiveBackground())
        {
            return $this->merchant->getBackground();
        }
        return null;
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
            'merchant' => $this->merchant,
            'template_path' => $this->templatePath(),
            'box_content' => $this->boxContent(),
        ];
    }

    public function templatePath()
    {
        return $this->merchant->template->file_name;
    }

    protected function boxContent():array
    {
        return [];
    }
}
