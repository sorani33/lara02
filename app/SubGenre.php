<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubGenre extends Model
{
    //
    //指定するテーブル名を追加
    protected $table = 'sub_genres';


    public function genres(){
        return $this->belongsTo('App\Genres');
    }
}
