<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategaryPost extends Model
{
    protected $fillable = ['name' , 'slug' , 'parent_id' ,'status_id' ,'user_id'];
        function status(){
            return  $this->belongsTo('App\Status_page');
        }
        function user(){
            return $this->belongsTo('App\User');
        }
        function post(){
            return  $this->hasMany('App\Post' , 'categary_id');
        }
    //
}
