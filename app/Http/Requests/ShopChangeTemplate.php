<?php

namespace App\Http\Requests;

use App\Models\Enums\VoucherType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopChangeTemplate extends Request
{
    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'template_id' => ['required', Rule::exists('templates', 'id')],
        ];
    }
}
