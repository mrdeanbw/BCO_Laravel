<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () { 
    return view('home');
});

//Public pages
Route::get('/why-join', function() { return view('public.why-join'); });
Route::get('/who-we-are', function() { return view('public.who-we-are'); });
Route::get('/non-profit-status', function() { return view('public.non-profit-status'); });
Route::get('/board', function() { return view('public.board'); });
Route::get('/shippingrates', function() { return view('public.shippingrates'); });



Route::get('register-js', function() {
	return view('auth.register-js');
});

Auth::routes();
Route::group(['middleware' => ['subscriber']], function() {
	Route::get('/members', 'DashboardController@index');

	//CHATTER FORUM ROUTES
	$chatter_url = Config::get('chatter.routes.home');
	Route::get($chatter_url, 'Chatter\ChatterController@index');

	Route::get($chatter_url.'/login', 'Chatter\ChatterController@login');
	Route::get($chatter_url.'/register', 'Chatter\ChatterController@register');

	$chatter_category_url = Config::get('chatter.routes.home') . '/' . Config::get('chatter.routes.category');
	Route::get($chatter_category_url . '/{slug}', 'Chatter\ChatterController@index');

	$discussion_url = Config::get('chatter.routes.home') . '/' . Config::get('chatter.routes.discussion');
	Route::resource($discussion_url, 'Chatter\ChatterDiscussionController');
	Route::get($discussion_url . '/{category}/{slug}', 'Chatter\ChatterDiscussionController@show');

	$posts_url = Config::get('chatter.routes.home') . '/posts';
	Route::resource($posts_url, 'Chatter\ChatterPostController');
	//END CHATTER FORUM ROUTES
	

	Route::group(array('prefix' => 'members'), function() {
		//NEWS
		Route::model('news', 'App\NewsItem');
		Route::resource('news', 'NewsItemController');
	});

	//USERS
	Route::model('users', 'App\User');
	Route::resource('users', 'UserController', ['except' => ['index', 'show', 'create', 'store', 'destroy']]);
	Route::group(array('prefix' => 'users', 'middleware' => ['auth']), function() {
		Route::get('/inbox/{user}', 'UserController@inbox');
		Route::get('/inbox/{user}/{msg}', 'UserController@message');
		Route::put('/update_pwd/{user}', 'UserController@update_password');
	});

	//SUBSCRIPTIONS
	Route::model('subscriptions', 'App\Subscription');
	Route::resource('subscriptions', 'SubscriptionController', ['except' => ['show', 'create', 'store']]);

	
});

Route::group(array('prefix' => 'subscriptions', 'middleware'=>['auth']), function() {
	Route::get('choose', 'SubscriptionController@choose');
	Route::get('checkout/{type}', 'SubscriptionController@checkout');
	Route::post('', 'SubscriptionController@store');	
	Route::get('confirmed', 'SubscriptionController@confirmed');	
});

//STRIPE
Route::post('stripe/webhook', '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook');

