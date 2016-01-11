<?php

namespace PostCheck\Http\Controllers;

use Illuminate\Http\Request;

use PostCheck\Http\Requests;
use PostCheck\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.index');
    }
}
