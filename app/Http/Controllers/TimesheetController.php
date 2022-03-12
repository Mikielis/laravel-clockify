<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function __construct()
    {
        view()->share('nav', 'timesheet');
    }

    public function index()
    {

    }
}
