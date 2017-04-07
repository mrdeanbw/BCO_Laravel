<?php

namespace App\Http\Controllers\Auth;

use Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class VerifyEmailController extends Controller
{

     public function verify_email(Request $request) {
        $message = '';

        if(Request::has('t')) {
            $message = "<strong>Thanks for signing in, unfortunately your email hasn't been verified yet.</strong><br>In case you haven't received our verification, please use the form below to resend it.";
            $action="resend";
            return \View::make('auth.email_verification')->withO(['message'=>$message, 'action'=>$action]);
        }

        if(!Request::has('token')) {
            $message =  "Token is missing...";
            $action='resend';
             return \View::make('auth.email_verification')->withO(['message'=>$message, 'action'=>$action]);
        }
        
        $user = User::where('verification_token', Request::get('token'))->first();
        if(!isset($user)) {
            $message =  "Unknown verification token";
            $action='resend';
             return \View::make('auth.email_verification')->withO(['message'=>$message, 'action'=>$action]);
        }

        if($user->email_verified) {
            $message =  "Your email address has already been verified";
            $action='login';
             return \View::make('auth.email_verification')->withO(['message'=>$message, 'action'=>$action]);
        }

        $user->email_verified = true;
        $user->save();
        $message = '<strong>Thank You!</strong><br>Your email address has been verified';
        $action='login';


        return \View::make('auth.email_verification')->withO(['message'=>$message, 'action'=>$action]);

        
    }

    public function resend_verification(Request $request) {
        $data = Request::all();
        $validator = Validator::make($data, [           
            'email' => 'required|email|max:255|exists:users',            
            'g-recaptcha-response' => 'required',            
        ]);

        $validator->after(function($validator) use ($data)  {
            $recaptcha_response = $this->verify_reCaptcha($data);
            if($recaptcha_response[0] == false) {
                $validator->errors()->add('recaptcha', 'reCaptcha failed verification');
            }
        });
        
        if($validator->fails()) {
            return \View::make('auth.email_verification')->withO(['message'=>'', 'action'=>'resend'])
            ->withErrors($validator)
            ->withInput(Request::all());
        } else {

            $user = User::where('email', $data['email'])->first();
            if(!isset($user)) {                
                $message =  "User belonging to this email address could not be found";
                $action='resend';
                return \View::make('auth.email_verification')->withO(['message'=>$message, 'action'=>$action]);        
            }

            if($user->email_verified) {
                $message =  "Your email address has already been verified";
                $action='login';
                return \View::make('auth.email_verification')->withO(['message'=>$message, 'action'=>$action]);
            }

            $user->notify(new \App\Notifications\EmailConfirmationRequired());
            $message = '<strong>We have resent the notificaiton email, please check your email.</strong><br>Once you are done log in using the button below.';
            $action='login';


            return \View::make('auth.email_verification')->withO(['message'=>$message, 'action'=>$action]);
        }
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