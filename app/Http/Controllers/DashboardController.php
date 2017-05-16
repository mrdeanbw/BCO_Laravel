<?php

namespace App\Http\Controllers;

use Request;
use Session;
use Validator;
use App\Http\Requests;
use App\Notifications\News;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;

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

    public function refer() {
        return view('dashboard.refer');
    }

    public function refer_submit(Request $request) {
        
        $rules = array(
        'first_name' => 'required|min:1|max:50',
        'last_name' => 'required|min:1|max:50',
        'email' => 'required|email|unique:referrals|max:255',
        'message' => 'required|min:20|max:500',
        'phonenumber' => 'max:255',            
        'agree' => 'required');

        $validator = Validator::make(Request::all(), $rules);

        if($validator->fails()) {
            return Redirect::to('members/refer')
            ->withErrors($validator)
            ->withInput(Request::all());
        } else {
            $referral = \App\Referral::create([
                'first_name' => Request::get('first_name'),
                'last_name' => Request::get('last_name'),
                'email' => Request::get('email'),
                'message' => Request::get('message'),
                'phonenumber' => Request::get('phonenumber'),
                'user_id' => \Auth::user()->id
            ]);

            event(new \App\Events\NewReferral($referral));

            Session::flash('message', 'Your referral has been submitted, thank you!');
            return redirect('/members/refer');
        }

        
    }
}
