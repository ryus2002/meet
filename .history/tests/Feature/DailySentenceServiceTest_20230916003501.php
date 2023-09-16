<?php

namespace Tests\Feature;

use App\Providers\DailySentenceService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DailySentenceServiceTest extends TestCase
{
    public function testGetSentenceSuccess()
    {
        $service = new DailySentenceService();

        // 调用服务类的方法，传递实际的 HTTP 响应
        $sentence = $service->getSentence();

        // 使用 assertNotEmpty 来判断返回结果不为空
        $this->assertNotEmpty($sentence);
    }

    /*
     * 模擬成功的 API 響應
     */
    public function testFakeApiGetSentenceSuccess()
    {
        // 模擬成功的 API 響應
        // 使用 Http Facade 的 mock 方法模擬成功的 API 響應
        Http::fake([
            'http://metaphorpsum.com/sentences/3' => Http::response('{"sentence": "This is a test sentence."}', 200),
        ]);

        $service = new DailySentenceService();
        $sentence = $service->getSentence();

        $this->assertEquals('{"sentence": "This is a test sentence."}', $sentence);
    }

    /*
     * 模擬API傳回HTTP 500測試
     */
    public function testFakeApiGetSentenceFailure()
    {
        // 模擬失敗的 API 響應
        // 使用 Http Facade 的 mock 方法模擬失敗的 API 響應
        Http::fake([
            'http://metaphorpsum.com/sentences/3' => Http::response('', 500),
        ]);

        $service = new DailySentenceService();
        $sentence = $service->getSentence();

        $this->assertEquals('從 API 取得資料時發生錯誤。', $sentence);
    }

    /*
     * 模擬API連接超時測試
     */
    public function testFakeApiTimeoutHandling()
    {
        // 使用 Http Facade 的 fake 方法模擬連接超時
        Http::fake([
            'http://metaphorpsum.com/sentences/3' => function () {
                throw new ConnectionException('Connection timed out', 0);
            },
        ]);

        $service = new DailySentenceService();
        $sentence = $service->getSentence();
        // dd($sentence);
        // 檢查服務類是否正確處理超時情況
        $this->assertEquals('從 API 取得資料時發生錯誤。', $sentence);
    }

    /*
     * 模擬API無效Url測試
     */
    public function testFakeApiInvalidUrlHandling()
    {
        // 使用 Http Facade 的 fake 方法模擬請求時的 URL 錯誤
        Http::fake([
            'http://metaphorpsum.com/sentences/3' => Http::response('Invalid URL', 400),
        ]);

        $service = new DailySentenceService();
        $sentence = $service->getSentence();

        // 檢查服務類是否正確處理無效 URL 的情況
        $this->assertEquals('從 API 取得資料時發生錯誤。', $sentence);
    }
}
