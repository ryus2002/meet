<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SentenceRequest extends FormRequest
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
            'status' => 'in:-1,0,1,2,3,4,80,81,98,99,999',
        ];
    }

    public function attributes()
    {
        return [
            'status.in' => '参数无效',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 的欄位必填。',
            'status.in' => 'status 参数无效，必须是 -1, 0, 1, 2, 3, 4, 80, 81, 98, 99, 999 中的一个。',
        ];
    }
}
