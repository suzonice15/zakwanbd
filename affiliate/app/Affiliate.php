<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
 use Illuminate\Notifications\Notifiable;

class Affiliate extends Model
{
    protected $table='users_public';
    protected $guarded=['_token'];
}
