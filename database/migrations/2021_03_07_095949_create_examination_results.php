<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('ユーザID');
            $table->integer('genre_id')->comment('ジャンルID');
            $table->integer('mode')->comment('モード（１：練習問題、２：５問タイムアタック）');
            $table->integer('number_questions')->comment('問題数');
            $table->integer('number_correct_answers')->comment('正解数');
            $table->integer('mark')->comment('得点');
            $table->time('time_attack', 6)->nullable()->comment('タイムアタック');
            $table->integer('best_time_flag')->nullable()->comment('ベストタイムフラグ（０：ベストタイムでない、１：ベストタイムである）');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examination_results');
    }
}
