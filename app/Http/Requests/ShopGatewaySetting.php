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
 * @method getPaymentGatewayEnabledParam
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
            'payment_gateway_enabled' => ['required', 'boolean',],
            'merchant_id' => ['required_if:payment_gateway_enabled,true', 'numeric',],
            'pos_id' => ['required_if:payment_gateway_enabled,true', 'numeric',],
            'crc' => ['required_if:payment_gateway_enabled,true', 'string',],
            'sandbox' => ['required_if:payment_gateway_enabled,true', 'boolean',],
        ];
    }
}
