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
            'source.in' => 'The source parameter is invalid and must be one of Metaphorpsum or Itsthisforthat.',
        ]);

        // 如果验证失败，返回自定义错误响应
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }


        $source = 'Itsthisforthat';
        // 根据用户的选择创建相应的策略实例
        if ($source === 'Metaphorpsum') {
            $this->strategy = new DailySentenceService();
        } elseif ($source === 'Itsthisforthat') {
            $this->strategy = new ItsthisforthatSentenceService();
        }

        $sentence = $this->strategy->getSentence();

        return response()->json([
            'text' => $sentence,
            // 其他数据...
        ], JsonResponse::HTTP_OK);
    }
}
