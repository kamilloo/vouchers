<?php

namespace App\Http\Requests;

use App\Models\Enums\VoucherType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class VoucherStore
 * @package App\Http\Requests
 * @method getTitleParam
 * @method getDescriptionParam
 * @method getActiveParam
 */
class ServiceCategoryUpdateRequest extends Request
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
            'description' => ['nullable', 'string', 'max:256'],
            'active' => ['required', 'boolean'],
        ];
    }
}
