<?php

namespace App\Http\Controllers;

use App\Providers\DailySentenceService;
use App\Providers\Interfaces\DailySentenceServiceInterface;

class SentenceController extends Controller
{
    private $dailysentenceService;

    public function __construct(DailySentenceServiceInterface $metaphorpsumService) {
        $this->metaphorpsumService = $metaphorpsumService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dailysentenceService = new DailySentenceService();
        $sentence = $dailysentenceService->getSentence();
        echo $sentence;
    }
}
