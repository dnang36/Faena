<?php

namespace App\Http\Requests\Chart;

use Illuminate\Foundation\Http\FormRequest;

class ChartRequest extends FormRequest
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
            'from-date' => 'required',
            'to-date' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'from-date.required' => 'Chưa nhập ngày bắt đầu!',
            'to-date.required' => 'Chưa nhập ngày kết thúc!'
        ];
    }
}