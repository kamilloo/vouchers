<?php

namespace App\Http\Requests;

use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class Checkout
 *
 * @method getVoucherIdParam
 * @method getDeliveryParam
 * @method getPriceParam
 * @method getFirstNameParam
 * @method getLastNameParam
 * @method getPhoneParam
 * @method getEmailParam
 * @method getClientParam
 */
class Checkout extends Request
{
    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'voucher_id' => ['required', Rule::exists('vouchers', 'id')],
            'delivery' => ['required', Rule::in(DeliveryType::all())],
            'price' => ['required', 'numeric'],
            'first_name' => ['required', 'string', 'max:256'],
            'last_name' => ['required', 'string', 'max:256'],
            'phone' => ['required', 'string', 'max:256'],
            'email' => ['required', 'email', 'max:256'],
            'client' => ['required', 'array'],
            'client.name' => ['required', 'string', 'max:256'],
            'client.email' => ['required', 'email', 'max:256'],
            'client.phone' => ['required', 'string', 'max:256'],
            'client.city' => ['required', 'string', 'max:256'],
            'client.address' => ['required', 'string', 'max:256'],
            'client.postcode' => ['required', 'string', 'max:256'],
            'client.country' => ['required', 'string', 'max:256'],
        ];
    }
}
