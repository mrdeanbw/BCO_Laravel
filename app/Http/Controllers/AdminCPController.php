<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCPController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth', 'admincp']);
    }

    public function index() {
        $users = \App\User::orderBy('created_at', 'desc')->get();
        return \View::make('admincp.index')->withUsers($users);
    }
}
