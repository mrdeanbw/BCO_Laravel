<?php


/////http://itsolutionstuff.com/post/laravel-5-stripe-example-using-laravel-cashier-from-scratchexample.html

namespace App\Http\Controllers;

use Request;
use App\User;
use App\Subscription;
use Session;
use Illuminate\Support\Facades\Redirect;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return \View::make('subscriptions.choose');	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function choose() {    	

        $user = \Auth::user();
        $subscription = $user->subscription('main');

    	return \View::make('subscriptions.choose')->withSubscription($subscription);	
    }

    public function checkout($type)
    {
        $trial = (Request::get('t') == 1);

        $user = \Auth::user();
        
    	\Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
    	$plan = \Stripe\Plan::retrieve("bcopower-".$type);
    	return \View::make('subscriptions.checkout')->withType($type)->withPlan($plan)->withTrial($trial);       
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //	
        	$user= \Auth::user();

            $input = Request::all();
            $token = $input['stripeToken'];            

             try {
                if($input['trial'] == 1) {
                    $user->newSubscription('main', $input['plan_id'])
                        ->trialDays(14)
                        ->create($token,[
                            'email' => $user->email
                        ]);
                } 
                else {
                    $user->newSubscription('main', $input['plan_id'])->create($token,[
                            'email' => $user->email
                        ]);
                }
                return Redirect::to('/subscriptions/confirmed');
            } catch (Exception $e) {
                return back()->with('success',$e->getMessage());
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
            //
        $user = User::find($id);
        $subscription = $user->subscription('main');

        \Stripe\Stripe::setApiKey("sk_test_cpqxiyOlpUl96IDvNoxKCq48");

        $subscription = \Stripe\Subscription::retrieve($subscription->stripe_id);

        return \View::make('subscriptions.edit')->withUser($user)->withSubscription($subscription);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
        $input = $request->all();
        $plan_id = $input['plan_id'];
        $user->subscription('main')->swap($plan_id);
        Session::flash('message', 'Succesfully changed your plan!');
        return Redirect::to('/subscriptions/'.$user->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirmed() {
        return \View::make('subscriptions.confirmed');
    }
}
