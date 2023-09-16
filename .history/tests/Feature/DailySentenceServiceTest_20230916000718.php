<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Providers\DailySentenceService;

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


要增加超时测试，您可以使用 Laravel 的测试工具和 PHPUnit 提供的功能来模拟 API 请求超时情况。下面是一个示例代码，演示如何编写一个测试用例来测试 MetaphorpsumService 类的超时行为：

php
Copy code
use Tests\TestCase;
use App\Services\MetaphorpsumService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class MetaphorpsumServiceTest extends TestCase
{
    public function testTimeoutHandling()
    {
        // 使用 Http Facade 的 fake 方法模拟连接超时
        Http::fake([
            'http://metaphorpsum.com/sentences/3' => function () {
                throw new ConnectionException('Connection timed out', 0);
            },
        ]);

        $service = new MetaphorpsumService();
        $sentence = $service->getSentence();

        // 检查服务类是否正确处理超时情况
        $this->assertEquals('An error occurred while fetching data from the API.', $sentence);
    }
}
