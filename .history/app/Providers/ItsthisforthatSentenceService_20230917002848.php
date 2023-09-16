<?php

namespace App\Providers;

use App\Providers\Interfaces\SentenceServiceInterface;
use Illuminate\Support\Facades\Http;

class ItsthisforthatSentenceService implements SentenceServiceInterface
{
    private $url;

    public function __construct()
    {

    }

    /**
     * @return string Return the result of the URL
     */
    public function getSentence()
    {
        $this->url = "https://itsthisforthat.com/api.php?text";

        try {
            // 使用 cURL 包发送 GET 请求
            // 抓https網址需要證書，在正式機需修正，不使用CURLOPT_SSL_VERIFYPEER
            $isDebug = config('app.debug');

            if (isDebug) {
                $response = Http::withOptions([
                    'curl' => [CURLOPT_SSL_VERIFYPEER => false],
                ])->get($this->url);
            }
            else 

            if ($response->successful()) {
                // 请求成功，返回响应的内容
                return $response->body();
            } else {
                // 请求失败，记录错误日志或返回默认值
                \Log::error('從 API 取得資料時發生錯誤: ' . $response->status());
                return "從 API 取得資料時發生錯誤。";
            }
        } catch (\Exception $e) {
            // 捕捉例外，記錄錯誤日誌或返回預設值
            \Log::error('例外情況: ' . $e->getMessage());
            return "從 API 取得資料時發生錯誤。";
        }
    }
    // /**
    //  * Register services.
    //  */
    // public function register(): void
    // {
    //     //
    // }

    // /**
    //  * Bootstrap services.
    //  */
    // public function boot(): void
    // {
    //     //
    // }
}
