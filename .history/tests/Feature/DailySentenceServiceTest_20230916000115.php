<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

        $service = new MetaphorpsumService();
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

        $service = new MetaphorpsumService();
        $sentence = $service->getSentence();

        $this->assertEquals('An error occurred while fetching data from the API.', $sentence);
    }
}
