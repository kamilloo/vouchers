<?php

namespace App\Http\Resources;

use App\Models\Enums\DeliveryType;
use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @mixin  Voucher
 */
class VoucherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->presenter->toArray();

    }
}
