<?php

namespace App\Http\Controllers;

use Request;
use Session;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class AdminCPController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth', 'admincp']);
    }

    public function index(Request $request) {
        $users = \App\User::orderBy('created_at', 'desc')->paginate(15);
        return \View::make('admincp.index')->withUsers($users);
    }

    public function toggle_verification(Request $request, $user) {
        $user = \App\User::findOrFail($user);
        $user->admin_verifier = !$user->admin_verifier;
        $user->save();
        if ($user->admin_verifier && $user->exfreight_status != 'Pending' && $user->exfreight_status != 'Completed') {
            event(new \App\Events\UserAdminVerified($user));
        }
        Session::flash('message', $user->name . ' was ' . ($user->admin_verifier ? 'verified' : 'revoked'));
        return redirect('/admincp');
    }

    public function fill_exfreight_creds(Request $request, $user) {
        $user = \App\User::findOrFail($user);
        return \View::make('admincp.exfreight')->withUser($user);
    }

    public function save_exfreight_creds(Request $request, $user) {
        $rules = array(
            'exf_username' => 'required|min:5|max:255',
            'exf_apitoken' => 'required|min:5|max:255');
        
        $validator = Validator::make(Request::all(), $rules);

        if($validator->fails()) {
            return Redirect::to('admincp/u/exfreight/'.$user)
            ->withErrors($validator)
            ->withInput(Request::all());
        } else {
            $user = \App\User::findOrFail($user);
            $user->exf_apitoken = Request::get('exf_apitoken');
            $user->exf_username = Request::get('exf_username');
            $user->exfreight_status = 'Completed';
            $user->save();
        }
        Session::flash('message', 'ExFreight Credentials Added');
        return Redirect::to('admincp');
    }
}
