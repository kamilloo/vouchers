<?php

namespace App\Http\Resources;

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
            'id' => $this->id,
string $'delivery'
float $'price'
string $'first_name'
string $'last_name'
string $'phone'
string $'email'
string $'status'
int $'paid'
\Illuminate\Support\Carbon|null $'created_at'
\Illuminate\Support\Carbon|null $'updated_at'
        ]

    }
}
