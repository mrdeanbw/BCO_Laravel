<?php

namespace App\Http\Controllers;

use App\ContactRequest;
use App\User;
use Illuminate\Http\Request;
use Session;
use Validator;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Log;

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

			$zoho_lead = 'https://crm.zoho.com/crm/private/xml/Leads/insertRecords?authtoken='.env('ZOHO_CRM_KEY', 'none').'&scope=crmapi&newFormat=1&xmlData=<Leads><row no="1"><FL val="Lead Source">Online Store</FL><FL val="Company">'.$request->get('organization').'</FL><FL val="Last Name">'.$request->get('name').'</FL><FL val="Email">'.$request->get('email').'</FL><FL val="Description">'.$request->get('enquiry').'</FL></row></Leads>';
			
			$client = new Client;
			$response = $client->post($zoho_lead);
			$xml = simplexml_load_string($response->getBody());
			Log::info(json_encode($xml));
			try {
        		$id = $xml->result->recorddetail->FL["0"];
				$zohotask = 'https://crm.zoho.com/crm/private/xml/Tasks/insertRecords?authtoken='.env('ZOHO_CRM_KEY', 'none').'&scope=crmapi&newFormat=1&xmlData=<Tasks><row no="1"><FL val="Status">Not Started</FL><FL val="Subject">Answer Online Contact Request</FL><FL val="SEID">'.$id.'</FL><FL val="SEMODULE">Leads</FL><FL val="Send Notification Email">true</FL></row></Tasks>';

				$response = $client->post($zohotask);
				$xml = simplexml_load_string($response->getBody());
				Log::info(json_encode($xml));


			} catch(Exception $e) {
				
			}


			Session::flash('message', 'Succesfully submitted your contact request, someone will be in touch with you shortly.');
			return Redirect::to('contact-us');
		}	
	}
}
