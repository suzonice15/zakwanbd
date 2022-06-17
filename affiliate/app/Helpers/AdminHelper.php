<?php
namespace App\Helpers;
use Session;

class AdminHelper{

    public static function Admin_user_autherntication(){

        $user_id= Session::get('id');
        if($user_id > 0){
            return $user_id;
          //  Redirect::to('admin')->send();

        } else {
            $user_id=0;
            return $user_id;
        }

    }

}
