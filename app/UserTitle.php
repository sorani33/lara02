<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Title;

class UserTitle extends Model
{
    //
    //指定するテーブル名を追加
    protected $table = 'user_titles';

    // public function titles()
    // {
    //     return $this->belongsTo('App\Title');
    // }

    // public function users()
    // {
    //     return $this->belongsTo('App\User');
    // }
}
