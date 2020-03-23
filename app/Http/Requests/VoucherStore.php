<?php

namespace App\Http\Requests;

use App\Models\Enums\VoucherType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class VoucherStore
 * @package App\Http\Requests
 * @method getDescriptionParam
 * @method getTypeParam
 * @method getPriceParam
 * @method getProductIdParam
 */
class VoucherStore extends Request
{
    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => ['nullable', 'string', 'max:256'],
            'type' => ['required', Rule::in(VoucherType::all())],
            'price' => ['nullable', Rule::requiredIf($this->isQuoteVoucher()), 'numeric'],
            'product_id' => ['nullable', Rule::requiredIf($this->isProductVoucher()), 'numeric'],
            'file-name' => ['nullable', 'file'],
        ];
    }

    private function isProductVoucher():bool
    {
        return in_array($this->type, [
            VoucherType::SERVICE,
            VoucherType::SERVICE_PACKAGE,
        ]);
    }

    private function isQuoteVoucher():bool
    {
        return  $this->type === VoucherType::QUOTE;
    }

}
