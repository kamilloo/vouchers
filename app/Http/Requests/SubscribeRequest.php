<?php

namespace App\Http\Requests;

use App\Models\Enums\VoucherType;
use App\Models\ServiceCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class VoucherStore
 * @package App\Http\Requests
 * @method getEmailParam
 * @method getCaptchaParam
 */
class SubscribeRequest extends PassingEmailRequest
{
    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'captcha' => ['required', 'string'],
        ]);
    }
}
