<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDemand extends Model
{
    

    public function zone(){
        return $this->belongsTo('App\Models\Zone','zone_id','id');
    }
    
    public function shop(){
        return $this->belongsTo('App\Models\Shop','shop_id','id');
    }
}
