<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategaryProduct extends Model
{
    // 'name' => $request->input('name'),
    // 'slug' => $request->input('slug'),
    // 'status_id' => $request->input('select'),
    // 'parent_id' => $request->input('select'),
    // 'user_id'=> Auth::id(),
    protected $fillable = ['name' ,'slug' ,'status_id','parent_id' , 'user_id'];
    function status(){
        return  $this->belongsTo('App\Status_page');
    }
    function user(){
        return $this->belongsTo('App\User');
    }
    function product(){
        return $this->hasMany('App\Product' ,'categary_id');
    }
    public function categaryChild(){
        return $this->hasMany('App\CategaryProduct' ,'parent_id');
    }

    //
}
