<?php

namespace App\Http\Requests;

use App\Models\Enums\VoucherType;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class VoucherStore
 * @package App\Http\Requests
 * @method getTitleParam
 * @method getDescriptionParam
 * @method getActiveParam
 * @method getPriceParam
 * @method getCategoryIdParam
 * @method getCategoryTitleParam
 */
class ServicePackageStoreRequest extends Request
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
            'price' => ['required', 'numeric', 'min:1', 'max:1000'],
            'active' => ['required', 'boolean'],
            'category_id' => ['nullable', Rule::in(ServiceCategory::toMe()->pluck('id')), ],
            'category_title' => ['nullable', 'string', ],
            'services' => ['required', 'array', Rule::in(Service::toMe()->pluck('id'))],
            'services.*' => ['required', Rule::in(Service::toMe()->pluck('id'))],
        ];
    }
}
