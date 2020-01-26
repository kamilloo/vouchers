<?php

namespace App\Http\Requests;

use App\Models\Enums\BackgroundColorType;
use App\Models\Enums\VoucherType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ShopGatewaySetting
 *
 * @method getMerchantIdParam
 * @method getPosIdParam
 * @method getCrcParam
 * @method getSandboxParam
 */
class ShopGatewaySetting extends Request
{
    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'merchant_id' => ['required', 'numeric',],
            'pos_id' => ['required', 'numeric',],
            'crc' => ['required', 'string',],
            'sandbox' => ['required', 'boolean',],
        ];
    }
}
