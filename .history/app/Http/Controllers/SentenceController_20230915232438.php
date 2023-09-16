<?php

namespace App\Http\Controllers;
use App\Providers

class SentenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metaphorpsumService = new MetaphorpsumService();
        $sentence = $metaphorpsumService->getSentence();
        echo $sentence;
    }
}
