<?php

namespace App\Http\Controllers;

use App\Providers\DailySentenceService;
use App\Providers\Interfaces\SentenceServiceInterface;

class SentenceController extends Controller
{
    private $dailysentenceService;
    private $

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
            $strategy = new DailySentenceService();
        } elseif ($userChoice === 'Itsthisforthat') {
            $strategy = new ItsthisforthatSentenceService();
        }

        // $dailysentenceService = new DailySentenceService();
        $sentence = $this->strategy->getSentence();
        echo $sentence;
    }
}
