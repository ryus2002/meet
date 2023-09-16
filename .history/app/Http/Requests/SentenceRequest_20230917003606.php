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
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // base data
            'id' => 'integer|required',
            // 'theme' => 'required|max:255',
            // 'productName' => 'required|max:255',
            // 'start_date' => 'required|date_format:Y-m-d',
            // 'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            // 'payType' => 'required|between:1,2',
            // 'contractFee' => 'required_if:payType,1|between:0,200.00',
            'report_year' => 'required|max:255',
            'report_month' => 'required|max:255',
            'note' => 'nullable|string|max:100000',
            'billDate' => 'required|string|max:100',
            'billExecution' => 'required|string|max:100',
            // 'contractDiscountPrice' => 'max:255|nullable',

            // customer data
            'clientContact' => 'required|max:255',
            'contactPhone' => 'required|max:255',
            'contactEmail' => 'nullable|max:255',
            'contactLine' => 'nullable|max:255',

            // 扣款項目
            'distributor_monthly_debit' => 'nullable|array',
            'distributor_monthly_debit.*.debit-amount' => 'required|integer',

            //日報表
            'distributor_monthly_daily_report' => 'nullable|array',
            'distributor_monthly_daily_report.*.amount' => 'required|integer',

        ];
    }

    public function attributes()
    {
        return [
            // 'contract_id' => '委刊編號',
            // 'customer' => '客戶名稱',
            // 'theme' => '主題名稱',
            // 'start_date' => '走期開始日',
            // 'end_date' => '走期結束日',
            // 'payType' => '執行方式',
            // 'service_fee' => '服務費',
            // 'markup' => '服務費',
            // 'mediaPrice' => '媒體費',
            // 'makePrice' => '製作費',
            // 'dataPrice' => '數據費',
            // 'otherPrice' => '其他費用',
            // 'otherText' => '其他',
            // 'media.*.platform' => '媒體/頻道',
            // 'media.*.ADsFormat' => '形式',
            // 'media.*.vehicle' => '載具',
            // 'media.*.slot' => '版位/操作策略',
            // 'media.*.type' => '類型',
            'distributor_monthly_debit.*.debit-amount' => '扣款項目-扣款金額(未稅)',
            'distributor_monthly_daily_report.*.amount' => '日報表金額',
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
