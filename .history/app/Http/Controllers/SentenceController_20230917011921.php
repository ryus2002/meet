<?php

namespace App\Http\Controllers;

use App\Providers\DailySentenceService;
use App\Providers\Interfaces\SentenceServiceInterface;
use App\Providers\ItsthisforthatSentenceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SentenceController extends Controller
{
    private $dailysentenceService;
    private $strategy;

    public function __construct(SentenceServiceInterface $dailysentenceService)
    {
        $this->dailysentenceService = $dailysentenceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $source = $request->query('source');

        // 验证 'status' 字段
        $validator = Validator::make($request->all(), [
            'source' => 'required|in:Metaphorpsum,Itsthisforthat',
        ], [
            'source.in' => 'source 参数无效，必须是 Metaphorpsum, Itsthisforthat 中的一个。',
        ]);

        // 如果验证失败，返回自定义错误响应
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        // $request->validate([
        //     'source' => 'in:-1,0,1,2,3,4,80,81,98,99,999',
        // ], [
        //     'source.in' => 'status 参数无效，必须是 -1, 0, 1, 2, 3, 4, 80, 81, 98, 99, 999 中的一个。',
        // ]);

        // if ($source == "") {
        //     echo "無效參數";
        // }

        $source = 'Itsthisforthat';
        // 根据用户的选择创建相应的策略实例
        if ($source === 'Metaphorpsum') {
            $this->strategy = new DailySentenceService();
        } elseif ($source === 'Itsthisforthat') {
            $this->strategy = new ItsthisforthatSentenceService();
        }

        $sentence = $this->strategy->getSentence();
        echo $sentence;
    }
}
