<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
        use SoftDeletes;
    protected $fillable = ['page_title' , 'slug' , 'status_id' ,'user_id' ,'content'] ;
       public function status(){
        return  $this->belongsTo('App\Status_page');
       }

       public function user(){
        return  $this->belongsTo('App\User');
       }
    //
}
