<?php

namespace App\Http\Requests;

use App\Models\Enums\BackgroundColorType;
use App\Models\Enums\VoucherType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *
 *
 * @method getExpiryAfterParam
 * @method getDeliveryCostParam
 */
class ShopSettings extends Request
{
    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'expiry_after' => ['required', 'integer',],
            'delivery_cost' => ['required', 'numeric',],
        ];
    }
}
