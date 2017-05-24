<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    use HasApiTokens;

    protected $appends = ['distance'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'organization', 'city', 'country', 'state', 'industry_type', 'primary_commodity', 'cargo_types', 'trial_ends_at', 'other_industry_type', 'email_verified', 'verification_token', 'admin_verifier', 'lat', 'lng'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'is_admin', 'stripe_id', 'card_brand', 'card_last_four', 'trial_ends_at',
    ];

    protected $dates = [
        'trial_ends_at',
    ];
   
    public function is_subscribed() {
        return $this->subscribed('main');
    }

    public function privacy_settings() {
        return $this->hasOne('App\PrivacySettings');
    }

    public function trial_days_left() {
        $today = \Carbon\Carbon::today();
        return $today->diffInDays($this->trial_ends_at);
    }

    public function getDistanceAttribute() {
        $mylat = \Auth::user()->lat;
        $mylng = \Auth::user()->lng;
        return sqrt(pow(69.1 * ($this->lat - $mylat),2) + pow(69.1 * ($mylng - $this->lng) * cos($this->lat / 57.3), 2));
    }

}
