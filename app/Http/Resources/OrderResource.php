<?php

namespace App\Http\Resources;

use App\Models\Enums\DeliveryType;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @mixin  Order
 */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'delivery' => $this->presenter->delivery(),
            'full_name' => $this->presenter->fullName(),
            'phone' => $this->phone,
            'email' => $this->email,
            'qr_code' => $this->qr_code,
            'expired_at' => optional($this->expired_at)->toIso8601String(),
            'status' => $this->presenter->status(),
            'paid' => $this->paid(),
            'used_at' => optional($this->used_at)->toIso8601String(),
            'voucher' => new VoucherResource($this->voucher),
        ];

    }
}
