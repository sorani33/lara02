<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    //
    //指定するテーブル名を追加
    protected $table = 'titles';

    public function users()
    {
        return $this->belongsToMany('App\User');
    }


    // public function usertitles()
    // {
    //     return $this->hasMany('App\UserTitle');
    // }
}
