<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailImage extends Model
{
    protected $fillable =['name_detail' , 'product_id'];
    function product(){
        return $this->belongsTo('App\Product');
    }
    //
}
