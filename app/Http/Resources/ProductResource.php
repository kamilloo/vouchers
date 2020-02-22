<?php

namespace App\Http\Resources;

use App\Models\Enums\DeliveryType;
use App\Models\Order;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\Voucher;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @mixin Service|ServicePackage
 */
class ProductResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
        ];

    }
}
