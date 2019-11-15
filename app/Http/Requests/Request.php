<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

abstract class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    public function __call($method, $parameters)
    {
        $method = Str::snake($method);
        if (preg_match('/^get_.*_param$/', $method))
        {
            $input = substr($method, 4, -6);
            return $this->input($input);
        }
        return null;
    }
}
