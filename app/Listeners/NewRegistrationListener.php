<?php

namespace App\Listeners;

use App\Events\NewRegistration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;

class NewRegistrationListener
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
     * @param  NewRegistration  $event
     * @return void
     */
    public function handle(NewRegistration $event)
    {     
        // Log::info('New registration: '. json_encode($event->user));
        $zoho_acc = 'https://crm.zoho.com/crm/private/xml/Accounts/insertRecords?authtoken='.env('ZOHO_CRM_KEY', 'none').'&scope=crmapi&newFormat=1&xmlData=<Accounts><row no="1"><FL val="Account Name">'.$event->user->organization.'</FL><FL val="Billing City">'.$event->user->city.'</FL><FL val="Billing State">'.$event->user->state.'</FL><FL val="Billing Country">'.$event->user->country.'</FL><FL val="Industry">'.$event->user->industry_type.'</FL><FL val="Description">Created because the user registered on the BCO Power Portal. Primary Commodity: '.$event->user->primary_commodity.'. Cargo Types: '.$event->user->cargo_types.'</FL></row></Accounts>';
        // Log::info($zohorequest);
        $client = new Client;
        $response = $client->post($zoho_acc);
        // $xml = simplexml_load_string($response->getBody());
        // Log::info($xml->result->recorddetail->FL);
        $zoho_con = "https://crm.zoho.com/crm/private/xml/Contacts/insertRecords?duplicateCheck=1&authtoken=".env('ZOHO_CRM_KEY', 'none')."&scope=crmapi&newFormat=1&xmlData=<Contacts><row no='1'><FL val='Account Name'>".$event->user->organization."</FL><FL val='Last Name'>".$event->user->name."</FL><FL val='Email'>".$event->user->email."</FL></row></Contacts>";
        
        $response = $client->post($zoho_con);
        // $xml = simplexml_load_string($response->getBody());
        // Log::info(json_encode($xml));
        
    }
}
