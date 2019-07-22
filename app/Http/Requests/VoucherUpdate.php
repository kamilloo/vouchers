<?php

namespace App\Http\Requests;

use App\Models\Enums\VoucherType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoucherUpdate extends Request
{
    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:256'],
            'type' => ['required', Rule::in(VoucherType::all())],
            'price' => [Rule::requiredIf($this->type === VoucherType::QUOTE), 'number'],
            'service' => [Rule::requiredIf($this->type === VoucherType::SERVICE), 'string'],
        ];
    }
}
