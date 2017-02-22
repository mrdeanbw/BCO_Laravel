<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DevDojo\Chatter\Models\Post;
use DevDojo\Chatter\Models\Discussion;

class ApiController extends Controller
{
    //

	public function __construct() {

	}

	public function marketnews() {

		$client = new \GuzzleHttp\Client();
		$response = $client->get("http://americanshipper.com/feed.aspx?sn=ASDaily");


		if($response->getStatusCode() == 200) {
			$xml = strval($response->getBody()->getContents());
						
			return $xml;

		} else {
			return true;
		}


	}

	public function latest_news() {

		$news = \App\NewsItem::latest()->with(['created_by' => function($query) {
			$query->select('id', 'name');
		}
		])->limit(5)->get();
		
		return $news;
	}

	public function new_members() {
		$members = \App\User::latest()->select(['name', 'organization'])->limit(5)->get();

		return $members;
	}

	public function update_user_stocksymbols(Request $request) {
		$user = $request->user();
		$user->stocksymbols = $request->get('symbols');
		$user->save();
		return 1;
	}

	public function latest_forum_posts () {
		$posts = Post::with('discussion', 'user')->latest()->limit(5)->get();

		return $posts;
	}
}
