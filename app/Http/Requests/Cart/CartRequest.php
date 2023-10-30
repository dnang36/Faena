<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'cus_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'cus_name.required' => 'Chưa nhập tên!',
            'address.required' => 'Chưa nhập địa chỉ!',
            'phone_number.required' => 'Chưa nhập số điện thoại!'
        ];
    }
}