<?php

namespace App\Http\Controllers;

use Request;
use App\User;
use Carbon\Carbon;
use App\Http\Requests;
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
        $user = \Auth::user();
        $user->load('notifications');
        return \View::make('users.inbox')->withUser($user);
        
    }

    public function message($user_id, $notification_id) {
        $user = \Auth::user();
        $notification = \App\Notification::where('id', $notification_id)->where('notifiable_id', $user->id)->firstOrFail();
        
        if(null === $notification->read_at) {
            $notification->read_at = Carbon::now();
            $notification->save();
        }
        return \View::make('users.message')->withUser($user)->withNotification($notification)->withData(json_decode($notification->data))->withReply($notification_id);
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

    public function compose(Request $request, $user_id, $to_id) {

        $user = \Auth::user();
        $to = \App\User::findOrFail($to_id);
        if(null == Request::get('reply')) {
            return \View::make('users.compose')->withUser($user)->withTo($to)->withInput(['subject' => '', 'body'=>'']);
        } else {
            
            $notification = \App\Notification::where('id', Request::get('reply'))->firstOrFail();
            $notification = json_decode($notification->data);
            
            return \View::make('users.compose')->withUser($user)->withTo($to)->withInput(['subject' => (substr( $notification->subject, 0, 2 ) === "RE" ? '' : 'RE: ').$notification->subject, 'body' => '<br /><br />[<b>'.$notification->from_name.'</b>]:<br />' .$notification->body ]);
        }
    }

    public function send_message(Request $request) {
        
        $to_user = \App\User::findOrFail(Request::get('to_id'));
        $to_user->notify(new \App\Notifications\MemberMessage(\Auth::user(), Request::get('subject'), Request::get('body')));
        return Redirect::route('inbox', [\Auth::user()->id]);
    }
}
