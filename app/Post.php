<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
         use SoftDeletes;
    protected $fillable =['post_title' , 'categary_id' ,'thumbnail' ,'content' , 'excerpts' ,'user_id' ,'status_id'];
    function status(){
        return  $this->belongsTo('App\Status_page');
    }
    function user(){
        return $this->belongsTo('App\User');
    }
    function categary(){
        return $this->belongsTo('App\CategaryPost');
    }
    //
}
