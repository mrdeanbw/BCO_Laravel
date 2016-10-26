<?php


/////http://itsolutionstuff.com/post/laravel-5-stripe-example-using-laravel-cashier-from-scratchexample.html

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    	return \View::make('subscriptions.choose');	
    }

    public function create($type)
    {
    	\Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
    	$plan = \Stripe\Plan::retrieve("bcopower-".$type);
		
    	return \View::make('subscriptions.create')->withType($type)->withPlan($plan);       
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

            $input = $request->all();
            $token = $input['stripeToken'];
            

             try {
                $user->newSubscription('main', $input['plan_id'])->create($token,[
                        'email' => $user->email
                    ]);
                return \View::make('subscriptions.created');
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
}
