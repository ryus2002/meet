<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ContractSentenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'status.in' => 'status 参数无效，必须是 -1, 0, 1, 2, 3, 4, 80, 81, 98, 99, 999 中的一个。',

       ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 的欄位必填。',
            'required_with' => ':attribute 的欄位必填。',
            'digits-between' => ':attribute 數值錯誤 ',
            'integer'      => ':attribute 必須是正整數',
            'required_unless'      => '當類型非"其他"時  ( :attribute ) 為必填',
        ];
    }
}
