<?php

namespace App\Http\Requests;

use App\Models\Enums\BackgroundColorType;
use App\Models\Enums\VoucherType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *
 *
 * @method getExpiryAfterParam
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
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->session()->put('tab', 'settings');

        parent::failedValidation($validator); // TODO: Change the autogenerated stub
    }
}
