<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = User::find($id);

        $user->password = null;
        return \View::make('users.edit')->withUser($user);
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

    public function inbox($id) {
        $user = User::find($id);
        $user->load('notifications');
        return \View::make('users.inbox')->withUser($user);
        
    }

    public function message($user_id, $notification_id) {
        $user = User::find($user_id);
        $notification = \App\Notification::find($notification_id);
        if(null === $notification->read_at) {
            $notification->read_at = Carbon::now();
            $notification->save();
        }
        return \View::make('users.message')->withUser($user)->withNotification($notification);
    }

    public function update_password(Request $request, $id) {
        $user = User::find($id);

        $rules = array(
            'password' => 'required|min:6|confirmed');

        $validator = Validator::make($request->all(), $rules);
        die(json_encode($request->all()));
        if($validator->fails()) {
            return Redirect::to('users/'.$id.'/edit')
            ->withErrors($validator)
            ->withInput($request->all());
        } else {            
            Session::flash('message', 'Succesfully created a new post');
            
            return Redirect::route('users.edit', [$id]);
        }
    }
}
