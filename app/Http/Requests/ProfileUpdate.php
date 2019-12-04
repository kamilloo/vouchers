<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProfileUpdate
 *
 * @method getBranchesParam
 * @method getSkillsParam
 */
class ProfileUpdate extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['nullable', 'string', 'max:256'],
            'last_name' => ['nullable', 'string', 'max:256'],
            'company_name' => ['nullable', 'string', 'max:256'],
            'address' => ['nullable', 'string', 'max:256'],
            'city' => ['nullable', 'string', 'max:256'],
            'postcode' => ['nullable', 'string', 'max:256'],
            'phone' => ['nullable', 'string', 'max:256'],
            'avatar' => ['nullable', 'file'],
            'description' => ['nullable', 'string', 'max:256'],
            'homepage' => ['nullable', 'string', 'max:256'],
            'branches' => ['nullable', 'array',],
            'skills' => ['nullable', 'array',],
            'branches.*' => ['nullable', 'string', 'max:256'],
            'skills.*' => ['nullable', 'string', 'max:256'],
        ];
    }


}
