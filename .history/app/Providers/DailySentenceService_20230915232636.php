<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DailySentenceService extends ServiceProvider
{
    private $url;

    public function __construct() {
        $this->apiUrl = "http://metaphorpsum.com/sentences/3";
    }

    /**
     * @return string Return the result of the URL
     */
    public function getSentence()
    {
        $this->url = "http://metaphorpsum.com/sentences/3";

        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // 处理错误，例如记录错误日志或返回默认值
            curl_close($ch);
            return "An error occurred while fetching data from the API.";
        }

        curl_close($ch);

        // 返回 API 回傳內容
        return $response;
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
