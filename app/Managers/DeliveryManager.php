<?php
declare(strict_types=1);

namespace App\Managers;

use App\Models\Delivery;
use App\Models\Enums\DeliveryType;
use App\Models\Merchant;
use App\Models\ShopSettings;

class DeliveryManager
{
    /**
     * @param Merchant $merchant
     *
     * @return Delivery<array>
     */
    public function getForMerchant(Merchant $merchant): array
    {
        return $merchant->delivery()->get()->map(function (Delivery $delivery){
            return (new Delivery())->init($delivery->type, $delivery->cost);
        })->all();
    }
}
