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
    return view('newhome');
});
Route::get('/home', function () { 
    return view('newhome');
});

//Public pages
Route::get('/why-join', function() { return view('public.why-join'); });
Route::get('/who-we-are', function() { return view('public.who-we-are'); });
Route::get('/non-profit-status', function() { return view('public.non-profit-status'); });
Route::get('/contact-us', function() { return view('public.contact'); });
Route::post('/contact-us', 'ContactController@store')->name('contact.store');

// Route::get('register-js', function() {
// 	return view('auth.register-js');
// });

Route::get('/member/verify', 'Auth\VerifyEmailController@verify_email');
Route::post('/member/verify/resend', 'Auth\VerifyEmailController@resend_verification');

Auth::routes();
Route::group(['middleware' => ['subscriber', 'emailverification']], function() {
	Route::get('/members', 'DashboardController@index');
	Route::get('/members/industry-news', 'DashboardController@industry_news');
	Route::get('/members/stock-quotes', 'DashboardController@stock_quotes');
	Route::get('/members/benchmarking', 'DashboardController@benchmarking
	');

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

		Route::group(array('prefix' => 'directory', 'middleware' => ['auth', 'adminverification']), function() {
			Route::get('/', 'DirectoryController@index');
		});

		Route::group(array('prefix' => 'rates', 'middleware' => ['adminverification']), function() {
			Route::get('/', function() { return \View::make('rates.index');});
			Route::post('/ltl', 'RatesController@ltl');
			Route::post('/fcl', 'RatesController@fcl');
			Route::post('/parcel', 'RatesController@parcel');
			Route::get('/locations', 'RatesController@query_locations');
		});
		Route::get('/software', function() {return view('software.index'); });
	});

	//USERS
	Route::model('users', 'App\User');
	Route::resource('users', 'UserController', ['except' => ['index', 'show', 'create', 'store', 'destroy']]);
	Route::group(array('prefix' => 'users', 'middleware' => ['auth']), function() {
		Route::get('/inbox/{user}', 'UserController@inbox');
		Route::get('/inbox/{user}/{msg}', 'UserController@message');
		Route::put('/update_pwd/{user}', 'UserController@update_password');
		Route::get('/privacy/{user}', 'PrivacyController@show')->name('privacy.show');
		Route::put('/privacy/{user}', 'PrivacyController@update')->name('privacy.update');
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
	Route::get('{user}/cancel', 'SubscriptionController@cancel');
	Route::get('{user}/card', 'SubscriptionController@edit_card');
	Route::post('{user}/update_card', 'SubscriptionController@update_card');	
	Route::get('/testmail', function() {
		Auth::user()->notify(new \App\Notifications\TrialEnding(4));
	});
	
	Route::get('invoice/{invoice}', function (Request $request, $invoiceId) {
    return Request::user()->downloadInvoice($invoiceId, [
        'vendor'  => 'BCO Power',
        'product' => 'BCO Power Membership Subscription',
    ]);
	});
});

Route::group(['prefix' => 'admincp', 'middleware' => ['auth', 'admincp']], function() {
	Route::get('/', function() { return 'AdminCP';});
});

//STRIPE
Route::post('stripe/webhook', '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook');






Route::get('/test', function() {
		event(new \App\Events\NewRegistration(Auth::user()));
	});