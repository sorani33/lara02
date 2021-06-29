<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationResult extends Model
{
    //
    //指定するテーブル名を追加
    protected $table = 'examination_results';

    protected $fillable = [
        'user_id',
        'genre_id',
        'mode',
        'number_questions',
        'number_correct_answers',
        'mark',
        'time_attack',
        'best_time_flag',
    ];
}
