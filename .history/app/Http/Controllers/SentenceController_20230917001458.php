<?php

namespace App\Http\Controllers;

use App\Providers\DailySentenceService;
use App\Providers\Interfaces\SentenceServiceInterface;

class SentenceController extends Controller
{
    private $dailysentenceService;

    public function __construct(SentenceServiceInterface $dailysentenceService)
    {
        $this->dailysentenceService = $dailysentenceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userChoice = 'Metaphorpsum';
        // 根据用户的选择创建相应的策略实例
        if ($userChoice === 'Metaphorpsum') {
            $strategy = new MetaphorpsumStrategy();
        } elseif ($userChoice === 'Itsthisforthat') {
            $strategy = new ItsthisforthatStrategy();
        }

        // $dailysentenceService = new DailySentenceService();
        $sentence = $this->dailysentenceService->getSentence();
        echo $sentence;
    }
}
