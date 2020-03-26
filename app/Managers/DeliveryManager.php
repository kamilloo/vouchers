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
        $online_delivery = (new Delivery())->init(DeliveryType::ONLINE, DeliveryType::ONLINE_DELIVERY_COST);
        $personal_delivery = (new Delivery())->init(DeliveryType::PERSONAL, DeliveryType::PERSONAL_DELIVERY_COST);
        $delivery = [$online_delivery, $personal_delivery];


        if ($this->hasActivePostDelivery($merchant))
        {
            $post_delivery_cost = $this->getPostDeliveryCost($merchant);
            $post_delivery = (new Delivery())->init(DeliveryType::POST, $post_delivery_cost);
            $delivery[] = $post_delivery;
        }
        return $delivery;
    }

    /**
     * @param Merchant $merchant
     *
     * @return ShopSettings|null
     */
    private function getShopSettings(Merchant $merchant)
    {
        return optional($merchant->shopSettings);
    }

    /**
     * @param Merchant $merchant
     *
     * @return float
     */
    private function getPostDeliveryCost(Merchant $merchant):float
    {
        return $this->getShopSettings($merchant)->delivery_cost ?? 0;
    }

    /**
     * @param Merchant $merchant
     *
     * @return float
     */
    private function hasActivePostDelivery(Merchant $merchant):bool
    {
        return $this->getShopSettings($merchant)->delivery_cost !== null;
    }
}
