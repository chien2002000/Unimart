<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_page extends Model
{
       public function page(){
              return  $this->hasMany('App\Page');
        }
        public function categaryPost(){
            return  $this->hasMany('App\CategaryPost' ,'status_id');
        }
        public function post(){
            return  $this->hasMany('App\Post' ,'status_id');
        }
        public function categaryProduct(){
            return  $this->hasMany('App\CategaryProduct' , 'status_id');
        }
        function product(){
            return $this->hasOne('App\Product' ,'status_id');
        }
    //
}
