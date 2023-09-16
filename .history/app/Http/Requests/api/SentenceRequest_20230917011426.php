<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SentenceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status' => 'in:-1,0,1,2,3,4,80,81,98,99,999',
        ];
    }

    public function authorize()
    {
        return true; // 确保返回 true
    }
}
