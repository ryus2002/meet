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
            'contract_id' => '委刊編號',
            'customer' => '客戶名稱',
            'theme' => '主題名稱',
            'start_date' => '走期開始日',
            'end_date' => '走期結束日',
            'payType' => '執行方式',
            'service_fee' => '服務費',
            'markup' => '服務費',
            'mediaPrice' => '媒體費',
            'makePrice' => '製作費',
            'dataPrice' => '數據費',
            'otherPrice' => '其他費用',
            'otherText' => '其他',
            'media.*.platform' => '媒體/頻道',
            'media.*.ADsFormat' => '形式',
            'media.*.vehicle' => '載具',
            'media.*.slot' => '版位/操作策略',
            'media.*.type' => '類型',
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
