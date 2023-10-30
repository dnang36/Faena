<?php

namespace App\Http\Requests\Slide;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            'thumb' => 'required',
            'sort_by' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên slide!',
            'thumb.required' => 'Chưa chọn ảnh!',
            'sort_by.required' => 'Chưa chọn thứ tự!'
        ];
    }
}