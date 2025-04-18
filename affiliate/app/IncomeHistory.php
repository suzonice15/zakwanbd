<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
 use Illuminate\Notifications\Notifiable;

class IncomeHistory extends Model
{
    protected $table='income_comision_histories';
    protected $guarded=['_token'];
     
    public function incomeFor(){
        return  $this->belongsTo(Affiliate::class,'income_for','id');
    }
    public function incomeFrom(){
      return  $this->belongsTo(Affiliate::class,'income_from','id');
    } 
}

