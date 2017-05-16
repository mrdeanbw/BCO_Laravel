<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Referral extends Model
{
    //
    use Notifiable;

    protected $fillable = ['first_name', 'last_name', 'email', 'message', 'phonenumber', 'user_id'];

    public function created_by() {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
