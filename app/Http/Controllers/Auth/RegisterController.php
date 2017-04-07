<?php

namespace App\Http\Controllers\Auth;

use Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/subscriptions/confirmed';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'organization' => 'required|max:255',
            'city' => 'required|max:100',
            'country' => 'required|max:100',
            'state' => 'required',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required',
            'typeOther' => 'requiredIf:type,Other'
        ]);

        $validator->after(function($validator) use ($data)  {
            $recaptcha_response = $this->verify_reCaptcha($data);
            if($recaptcha_response[0] == false) {
                $validator->errors()->add('recaptcha', 'reCaptcha failed verification');
            }
        });
        
        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {        
        //Parse cargotypes
        $options = ['perishable', 'hazardous', 'fragile', 'liquid', 'highvalue', 'shippersowned'];
        $cargotypes = [];
        foreach($options as $option) {
            if(isset($data[$option])) {
               array_push($cargotypes, $option);
            }    
        }
        $cargotypes = implode(', ', $cargotypes);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'organization' => $data['organization'],
            'city' => $data['city'],
            'country' => $data['country'],
            'state' => isset($data['state']) ? $data['state'] : null,            
            'password' => bcrypt($data['password']),
            'industry_type' => $data['type'],
            'primary_commodity' => $data['commodity'],
            'cargo_types' => $cargotypes,
            'trial_ends_at' => \Carbon\Carbon::createFromDate(2017, 12, 31, 'Europe/London'),
            'verification_token' => str_random(40),
            'other_industry_type' => $data['typeOther']
            
        ]);        
        
        $user->save();        

        $privacy_settings = new \App\PrivacySettings();
        $privacy_settings->user_id = $user->id;
        $privacy_settings->save();

        $user->notify(new \App\Notifications\EmailConfirmationRequired());
        event(new \App\Events\NewRegistration($user));

        return $user;
    }

    protected function verify_reCaptcha(array $data) {


        if(null !== env('G_RECAPTCHA_ENDPOINT')) {
            if(!isset($data['g-recaptcha-response'])) {
                return [false, 'missing parameter g-recaptcha-response'];
            }

            $secret = env('G_RECAPTCHA_SECRET', '');
            $g_recaptcha_response = $data['g-recaptcha-response'];
            $userip = Request::ip();

            $client = new \GuzzleHttp\Client();
            $response = $client->post(env('G_RECAPTCHA_ENDPOINT'), ['form_params'=>['secret' => $secret, 'response'=>$g_recaptcha_response, 'remoteip' => $userip]]);
            

            if($response->getStatusCode() == 200) {
                $body = json_decode($response->getBody()->getContents());
                
                $errorcodes = '';                
                if(property_exists($body, 'error-codes')) {
                    $errorcodes = $body->{'error-codes'};
                }
                return[$body->success, $errorcodes];

            } else {
                return true;
            }

        }
        else {
            return true;
        }
    }

   
}
