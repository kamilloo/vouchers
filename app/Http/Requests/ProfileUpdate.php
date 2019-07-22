<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'address' => ['nullable', 'string', 'max:256'],
            'company_name' => ['nullable', 'string', 'max:256'],
            'first_name' => ['nullable', 'string', 'max:256'],
            'last_name' => ['nullable', 'string', 'max:256'],
            'services' => ['nullable', 'string', 'max:256'],
//            'avatar' => ['nullable', 'file'],
            'logo' => ['nullable', 'file'],
            'description' => ['nullable', 'string', 'max:256'],
            'branch' => ['nullable', 'string', 'max:256'],
        ];
    }


}
