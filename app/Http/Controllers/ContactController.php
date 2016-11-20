<?php

namespace App\Http\Controllers;

use App\ContactRequest;
use App\User;
use Illuminate\Http\Request;
use Session;
use Validator;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    //

	public function store(Request $request) {

		$rules = array(
			'name' => 'required|min:5|max:255',
			'email' => 'required|email',
			'organization' => 'required',
			'enquiry' => 'required|max:500');

		$validator = Validator::make($request->all(), $rules);
		if($validator->fails()) {
			return Redirect::to('contact-us')
			->withErrors($validator)
			->withInput($request->all());
		} else {
			$contact_request = new ContactRequest();
			$contact_request->name = $request->get('name');
			$contact_request->email = $request->get('email');
			$contact_request->organization = $request->get('organization');
			$contact_request->enquiry = $request->get('enquiry');

			$contact_request->save();


			$notify_users = User::where('is_admin', '=', '1')->get();
			\Notification::send($notify_users, new \App\Notifications\ContactRequestNotification($contact_request));


			Session::flash('message', 'Succesfully submitted your contact request, someone will be in touch with you shortly.');
			return Redirect::to('contact-us');
		}	
	}
}
