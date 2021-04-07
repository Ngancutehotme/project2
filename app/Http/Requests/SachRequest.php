<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SachRequest extends FormRequest
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
            'ten_sach' => 'required',
            'so_luong' => 'required',
            'ma_nganh' => 'required',
            'ma_mon'   => 'required'
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
            'ten_sach' => 'Book',
            'so_luong' => 'Number of books',
            'ma_nganh' => 'Major',
            'ma_mon'   => 'Subject'
        ];
    }
}