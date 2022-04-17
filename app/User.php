<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }
    public function categaryPost(){
        return  $this->hasMany('App\CategaryPost');
    }
    public function post(){
        return $this->hasMany('App\Post');
    }
    public function page(){
        return $this->hasMany('App\Post' ,'user_id');
    }
    public function categaryProduct(){
        return  $this->hasMany('App\CategaryProduct' , 'user_id');
    }
    function product(){
        return $this->hasMany('App\Product' ,'user_id');
    }
}
