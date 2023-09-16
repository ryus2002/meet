<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SentenceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'source' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'source' => '每日一句來源',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 的欄位必填。',
        ];
    }
}
