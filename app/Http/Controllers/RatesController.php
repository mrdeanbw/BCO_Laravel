<?php

namespace App\Http\Controllers;

use Request;
use App\User;
use App\Subscription;
use Session;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;

class RatesController extends Controller
{


	public function query_locations(Request $request) {
		if(!Request::has('query')) {
			return response()->json(['error' => 'A query parameter is required'], 400);
		}

		$results = \App\RateLocation::where('display_name', 'like', '%'.Request::get('query').'%')->orderBy('display_name')->get();
		
		return response()->json($results);
	}


	public function ltl(Request $request) {
		
		$json = $this->transform_exfreight_ltl(Request::all());
		
		return $this->query_exfreight($json);
	}

	public function fcl(Request $request) {
		
		$json = $this->transform_exfreight_fcl(Request::all());
		
		return $this->query_exfreight($json);

	}

	public function parcel(Request $request) {
		$json  = $this->transform_shipstore_parcel_request(Request::all());
		
		return $this->query_shipstore($json);
	}


	private function query_shipstore($json) {
		$client = new Client;

		try {
			$response = $client->post('http://arecloudship.com/api/shipment', [
				'json' => $json,
				'Content-Type' => 'application/json']);
		} catch (RequestException $e) {
			$resp = $e->getResponse();
			return response()->json(Psr7\str($resp), $resp->getStatusCode());
		} catch(ClientException $e) {
			
			$resp = $e->getResponse();
			return response()->json(Psr7\str($resp), $resp->getStatusCode());
		}

		if($response->getStatusCode() == 200) {
			$body = json_decode($response->getBody());			
			$body = $this->transform_shipstore_parcel_response($body);
			return response()->json($body);
		} else {
			return response()->json('error', 500);
		}
	}


	private function query_exfreight($json) {
		$client = new Client;

		try {
			$response = $client->post('http://exfreight-sandbox.flipstone.com/api/v1/rating', [
				'json' => $json,
				'headers' => [
				'Authorization' => 'token f64e9f0fb0a1f324']
				]);
		} catch (RequestException $e) {
			$resp = $e->getResponse();
			return response()->json(Psr7\str($resp), $resp->getStatusCode());
		} catch(ClientException $e) {
			
			$resp = $e->getResponse();
			return response()->json(Psr7\str($resp), $resp->getStatusCode());
		}

		if($response->getStatusCode() == 200) {
			$body = json_decode($response->getBody());			
			dd($body);
			return response()->json($body);
		} else {
			return response()->json('error', 500);
		}
	}

	private function transform_shipstore_parcel_response($response) {
				
		$error = $response->Shipment->TransError;
		if($error == '') {

			$json = ['success' => true, 'error' => null, 'rate' =>[
				'carrier' => $response->Shipment->CarrierName,
				'from' => $response->Shipment->ShipFrom_Zip,
				'to' => $response->Shipment->ShipTo_Zip,
				'total_price' => $response->Shipment->TotalCharge]

			];
		} else {
			$json = ['success' => false, 'error' => $error, 'rate' => null];
		}

		return $json;
		
	}


	private function transform_shipstore_parcel_request($data) {
		
		$date = new \Carbon\Carbon($data['ship_day']);
		
		$json = ['Shipment' => [
			'RequestType' => 'RATE',
			'OrderNumber' => 'BCOPOWER',
			'Source'=> 'MANUAL',
			'ServiceCode'=> 'ARE_API.ARE.UPS.G',
			'ProfileId' => '9AF87637-34E3-49AA-A832-73FDD214456D',
			'ClientID' => 'B4F6E4E4-7795-49FB-BE2D-FAA28E49F66C',

			'Terms'=> $data['terms'],
			'ShipFrom_ID'=> null,
			'ShipFrom_Company'=> 'BCO Power',
			'ShipFrom_Contact'=> 'Rates Engine',
			'ShipFrom_Address1'=> null,
			'ShipFrom_City'=> $data['from']['name'],
			'ShipFrom_Zip'=> $data['from']['code'],
			'ShipFrom_State' => $data['from']['state'],
			'ShipFrom_Country'=> $data['from']['country'],
			'ShipTo_Address1'=> null,
			'ShipTo_City'=> $data['to']['name'],
			'ShipTo_State'=> $data['to']['state'],
			'ShipTo_Zip'=> $data['to']['code'],
			'ShipTo_Country'=> $data['to']['country'],
			'Packages' => $data['packages']
		]];

		
		return $json;

	}


	private function transform_exfreight_ltl($data) {
		
		$date = new \Carbon\Carbon($data['ship_day']);
				
		$json = [
			'username' => 'mmotsick@hotmail.com',
			'pickup' => $data['pickup'],
			'delivery' => $data['delivery'],
			'ship_day' => $date->toDateString(),
			'ltl' => [
				'accessorials' => [],
				'items' => $data['items']
			]
		];

		if($data['us_domestic']) {
			$json['ltl']['freight_class'] = $data['freight_class'];
		}

		return $json;
	}

	private function transform_exfreight_fcl($data) {
		$date = new \Carbon\Carbon($data['ship_day']);
				
		$json = [
			'username' => 'mmotsick@hotmail.com',
			'pickup' => $data['pickup'],
			'delivery' => $data['delivery'],
			'ship_day' => $date->toDateString(),
			'fcl' => [				
				'containers' => $data['containers']
			]
		];

		return $json;
	}





}