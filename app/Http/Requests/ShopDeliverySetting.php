<?php

namespace App\Http\Requests;

use App\Models\Enums\BackgroundColorType;
use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *
 * @method getDeliveryParam
 */
class ShopDeliverySetting extends Request
{
    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delivery' => ['required', 'array',],
            'delivery.*.type' => ['required', Rule::in(DeliveryType::all()),],
            'delivery.*.cost' => ['nullable', 'numeric',],
            'delivery.*.status' => ['required', 'boolean',],
        ];
    }
}
