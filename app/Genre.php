<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    //指定するテーブル名を追加
    protected $table = 'genres';


    public function subgenres(){
        return $this->hasmany('App\SubGenre');
    }
}
