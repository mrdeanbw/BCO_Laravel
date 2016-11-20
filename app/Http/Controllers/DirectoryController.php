<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    //
    public function __construct() {
		$this->middleware('auth');
    }

    public function index() {
    	$search_name = \Request::get('name');
    	$search_org = \Request::get('org');    	

    	$members = \App\User::where([['name', 'like', '%'.$search_name.'%'],
    		['organization', 'like', '%'.$search_org.'%']])->whereHas('privacy_settings', function($query) {
                $query->where('directory_show', '=', '1');
            })
    		->orderBy('organization', 'DESC')->paginate(25);
        
    	return \View::make('directory.index')->withMembers($members);
    }
}
