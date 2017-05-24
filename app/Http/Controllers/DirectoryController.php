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
        $nearby = \Request::get('nearby');

        if($nearby) {
            $members = \App\User::orderBy('organization', 'ASC')->paginate(25);
            return \View::make('directory.index')->withMembers($members)->withRange(200);
        }


    	$members = \App\User::where([['name', 'like', '%'.$search_name.'%'],
    		['organization', 'like', '%'.$search_org.'%']])->whereHas('privacy_settings', function($query) {
                $query->where('directory_show', '=', '1');
            })
    		->orderBy('organization', 'ASC')->paginate(25);
        
    	return \View::make('directory.index')->withMembers($members)->withRange(-1);
    }
}
