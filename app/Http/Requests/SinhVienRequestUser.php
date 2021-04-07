<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SinhVienRequestUser extends FormRequest
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
            'ten_sv'    => 'required',
            'ngay_sinh' => 'required',
            'email'     => 'required',
            'SDT'       => 'required',
            'gioi_tinh' => 'required'
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
            'ten_sv'    => 'Name',
            'ngay_sinh' => 'Date birth',
            'email'     => 'Email',
            'SDT'       => 'Numberphone',
            'gioi_tinh' => 'Gender',
        ];
    }
}