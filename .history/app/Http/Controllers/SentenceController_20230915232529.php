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
        $metaphorpsumService = new DailySentenceService();
        $sentence = $metaphorpsumService->getSentence();
        echo $sentence;
    }
}
