<?php

namespace App\Http\Controllers;
use Request;
use Session;
use App\PrivacySettings;
use Illuminate\Support\Facades\Redirect;

class PrivacyController extends Controller
{
    //

    public function __construct() {
    	$this->middleware('auth');
    }

    public function show($user_id) {    	
    	$user = \App\User::find($user_id);
    	$user->load('privacy_settings');
    	if ($user->privacy_settings == null) {
    		$privacy_settings = new PrivacySettings();
    		$privacy_settings->user_id = $user->id;
    		$privacy_settings->save();

    		$user->load('privacy_settings');
    	}

    	return \View::make('users.privacy')->withUser($user);
    }

    public function update(Request $request, $id) {
        $user = \App\User::find($id);
        $privacy_settings = $user->privacy_settings;
        
        $privacy_settings->news_email = Request::get('news_email') ? 1 : 0;
        $privacy_settings->news_dm = Request::get('news_dm') ? 1 : 0;
        $privacy_settings->message_email = Request::get('message_email') ? 1 : 0;
        $privacy_settings->directory_show = Request::get('directory_show') ? 1 : 0;
        $privacy_settings->member_message_allow = Request::get('member_message_allow') ? 1 : 0;

        $privacy_settings->save();
        Session::flash('message', 'Your privacy settings have been updated');        
        return Redirect::route('privacy.show', [$user]);
    }
}
