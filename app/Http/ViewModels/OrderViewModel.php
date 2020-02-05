<?php
declare(strict_types=1);

namespace App\Http\ViewModels;

use App\Managers\DeliveryManager;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class OrderViewModel extends TemplateViewModel
{
    /**
     * @var Order
     */
    protected $order;

    public function __construct(Merchant $merchant, Order $order)
    {
        parent::__construct($merchant);
        $this->order = $order;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'order' => $this->order,
        ]);
    }
}
