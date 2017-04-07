<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.news');
    }

    public function industry_news() {
        return view('dashboard.industrynews');
    }

    public function stock_quotes() {
        return view('dashboard.stockquotes');
    }

    public function benchmarking() {
        return view('dashboard.benchmarking');
    }
}
