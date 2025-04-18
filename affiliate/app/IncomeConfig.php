<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
 use Illuminate\Notifications\Notifiable;

class IncomeConfig extends Model
{
    protected $table='incomeconfigs';
    protected $guarded=['_token'];
}
