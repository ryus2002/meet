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
        $dailySentenceService = new DailySentenceService();
        $sentence = $metaphorpsumService->getSentence();
        echo $sentence;
    }
}
