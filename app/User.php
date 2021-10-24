<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function post(){
        return $this->hasMany('App\Post');
    }
    public function comment(){
        return $this->hasMany('App\Comment');
    }

    // public function timeline(){
    //     $user=$this->follow()->pluck('id');
        
    //     return Post::whereIn("user_id",$user)->orWhere('user_id',$this->id)->withlikes()->latest();
    // }

    // public function likes(){
    //     return $this->hasOne('App\Like');
    // }
}
