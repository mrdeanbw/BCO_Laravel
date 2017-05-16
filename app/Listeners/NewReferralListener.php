<?php

namespace App\Listeners;

use App\Events\NewReferral;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;

class NewReferralListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewReferral  $event
     * @return void
     */
    public function handle(NewReferral $event)
    {
        $referral = $event->referral;
        $referred_by = \App\User::find($referral->user_id);

        //Send email notification
        $referral->notify(new \App\Notifications\Referral($referral, $referred_by));

        //Add to Zoho
        $zoho_lead = 'https://crm.zoho.com/crm/private/xml/Leads/insertRecords?authtoken='.env('ZOHO_CRM_KEY', 'none').'&scope=crmapi&newFormat=1&xmlData=<Leads><row no="1"><FL val="Lead Source">Online Store</FL><FL val="Company">'.$referred_by->organization.'</FL><FL val="Last Name">'.$referral->last_name.'</FL><FL val="Email">'.$referral->email.'</FL><FL val="Description">COLLEAGUE REFERRAL by ' .$referred_by->first_name . ' ' . $referred_by->last_name. ': '.$referral->message.'</FL></row></Leads>';			
        $client = new Client;
        $response = $client->post($zoho_lead);
        $xml = simplexml_load_string($response->getBody());

        
    }
}
