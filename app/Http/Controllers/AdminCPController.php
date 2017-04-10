<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

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
        Session::flash('message', $user->name . ' was ' . ($user->admin_verifier ? 'verified' : 'revoked'));
        return redirect('/admincp');
    }
}
