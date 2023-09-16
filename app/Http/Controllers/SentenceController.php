<?php

namespace App\Http\Controllers;

use App\Providers\DailySentenceService;

class SentenceController extends Controller
{
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
