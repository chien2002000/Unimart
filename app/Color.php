<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
        protected $fillable=['code_color' , 'name_color'];
        function product(){
            return $this->belongsToMany('App\Product');
        }
    //
}
