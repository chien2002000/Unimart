<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use SoftDeletes;
    protected $fillable =['product_title' , 'product_thumb' ,'code','excerpts','content',
    'categary_id' ,'user_id','status_id','product_hightlight','price'
];
    function status(){
        return  $this->belongsTo('App\Status_page');
    }
    function user(){
        return $this->belongsTo('App\User');
    }
    function categary(){
        return $this->belongsTo('App\CategaryProduct');
    }
    function detailImg(){
        return $this->hasMany('App\DetailImage' ,'product_id');
    }
    function color(){
        return $this->belongsToMany('App\Color' ,'add_colors');
    }
    //
}
