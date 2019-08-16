<?php

namespace App\Http\Requests;

use App\Models\Enums\VoucherType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopChangeImages extends Request
{
    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'logo_enabled' => ['required', 'boolean'],
            'front_enabled' => ['required', 'boolean'],
            'front' => ['nullable', 'file'],
            'logo' => ['nullable', 'file'],
        ];
    }
}
