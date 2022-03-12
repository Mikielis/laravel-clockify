<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function __construct()
    {
        view()->share('nav', 'home');
    }

    public function index()
    {
        return view('index.index');
    }
}
