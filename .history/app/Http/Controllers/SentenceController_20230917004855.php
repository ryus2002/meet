<?php

namespace App\Http\Controllers;

use App\Providers\DailySentenceService;
use App\Providers\ItsthisforthatSentenceService;
use App\Providers\Interfaces\SentenceServiceInterface;
use Illuminate\Http\Request;

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

        $request->validate([
            'status' => 'in:-1,0,1,2,3,4,80,81,98,99,999',
        ], [
            'status.in' => 'status 参数无效，必须是 -1, 0, 1, 2, 3, 4, 80, 81, 98, 99, 999 中的一个。',
        ]);

        if ($source == "") {
            echo "無效參數";
        }

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
