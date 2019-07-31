<?php

namespace App\Http\Requests;

use App\Models\Enums\DeliveryType;
use App\Models\Enums\VoucherType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'email' => ['required', 'string', 'max:256'],
        ];
    }
}
