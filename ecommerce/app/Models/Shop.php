<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    
    protected $guarded = ['_token'];  

    public function Zone(){
        return $this->belongsTo('App\Models\Zone','zone_id','id');
    }
    
    public function User(){
        return $this->belongsTo('App\Models\Admin','admin_id','admin_id');
    }
}
