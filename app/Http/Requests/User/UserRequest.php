<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'repassword' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên tài khoản',
            'email.required' => 'Chưa nhập email',
            'password.required' => 'Chưa nhập mật khẩu',
            'repassword.required' => 'Chưa nhập lại mật khẩu'
        ];
    }
}