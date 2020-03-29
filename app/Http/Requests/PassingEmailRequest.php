<?php

namespace App\Http\Requests;

use App\Models\Enums\VoucherType;
use App\Models\ServiceCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @method getEmailParam
 */
class PassingEmailRequest extends Request
{
    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
        ];
    }
}
