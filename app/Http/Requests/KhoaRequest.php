<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhoaRequest extends FormRequest
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
            'ten_khoa' => 'required|min:2|max:10'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute cannot be left blank',
            'min' => ':attribute must not be less than :min',
            'max' => ':attribute must not be greater than :max'
        ];
    }
    public function attributes()
    {
        return [
            'ten_khoa' => 'Course'
        ];
    }
}
