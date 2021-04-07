<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NganhRequest extends FormRequest
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
    public function rules()
    {
        return [
            'ten_nganh' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute cannot be left blank'
        ];
    }
    public function attributes()
    {
        return [
            'ten_nganh' => 'Major'
        ];
    }
}