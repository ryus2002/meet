<?php

namespace App\Http\Controllers;

use App\Providers\DailySentenceService;
use App\Providers\ItsthisforthatSentenceService;
use App\Providers\Interfaces\SentenceServiceInterface;
use App\Http\Requests\ApiSentenceRequest;

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
    public function index(SentenceRequest $request)
    {
        $userChoice = 'Itsthisforthat';
        // 根据用户的选择创建相应的策略实例
        if ($userChoice === 'Metaphorpsum') {
            $this->strategy = new DailySentenceService();
        } elseif ($userChoice === 'Itsthisforthat') {
            $this->strategy = new ItsthisforthatSentenceService();
        }

        $sentence = $this->strategy->getSentence();
        echo $sentence;
    }
}
