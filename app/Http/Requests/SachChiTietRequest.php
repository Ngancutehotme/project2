<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SachChiTietRequest extends FormRequest
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
            'nganh' => 'required',
            'khoa'  => 'required',
            'mon'   => 'required',
            'sach'  => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute update'
        ];
    }
    public function attributes()
    {
        return [
            'nganh' => 'Error',
            'khoa'  => 'Error',
            'mon'   => 'Error',
            'sach'  => 'Error'
        ];
    }
}