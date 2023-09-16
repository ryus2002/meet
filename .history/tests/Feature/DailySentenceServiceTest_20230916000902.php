<?php

namespace Tests\Feature;

use App\Providers\DailySentenceService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DailySentenceServiceTest extends TestCase
{
    public function testGetSentenceSuccess()
    {
        // 模拟成功的 API 响应
        // 使用 Http Facade 的 mock 方法模拟成功的 API 响应
        Http::fake([
            'http://metaphorpsum.com/sentences/3' => Http::response('{"sentence": "This is a test sentence."}', 200),
        ]);

        $service = new DailySentenceService();
        $sentence = $service->getSentence();

        $this->assertEquals('{"sentence": "This is a test sentence."}', $sentence);
    }

    public function testGetSentenceFailure()
    {
        // 模拟失败的 API 响应
        // 使用 Http Facade 的 mock 方法模拟失败的 API 响应
        Http::fake([
            'http://metaphorpsum.com/sentences/3' => Http::response('', 500),
        ]);

        $service = new DailySentenceService();
        $sentence = $service->getSentence();

        $this->assertEquals('從 API 取得資料時發生錯誤。', $sentence);
    }

    public function testTimeoutHandling()
    {
        // 使用 Http Facade 的 fake 方法模拟连接超时
        Http::fake([
            'http://metaphorpsum.com/sentences/3' => function () {
                throw new ConnectionException('Connection timed out', 0);
            },
        ]);

        $service = new DailySentenceService();
        $sentence = $service->getSentence();
        // dd($sentence);
        // 检查服务类是否正确处理超时情况
        $this->assertEquals('從 API 取得資料時發生錯誤。', $sentence);
    }
}
