<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'avatar'
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


    // public function titles()
    // {
    //     // return $this->belongsToMany('App\Title');
    //     return $this->hasMany('App\UserTitle');
    // }

    public function titles()
    {
        return $this->belongsToMany('App\Title');
    }

    //hasMany設定
    public function examinationResult()
    {
        return $this->hasMany('App\ExaminationResult');
    }
}
