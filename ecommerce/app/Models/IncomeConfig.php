<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeConfig extends Model
{
     public $table='incomeconfigs';
     protected $guarded = ['_token'];

}
