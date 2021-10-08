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
            $table->unsignedBigInteger('user_id')->comment('ユーザID');
            $table->integer('genre_id')->comment('ジャンルID');
            $table->integer('sub_genre_id')->comment('ジャンルID');
            $table->integer('gamemode')->comment('モード（１：練習問題、２：５問タイムアタック）');
            $table->integer('number_questions')->comment('問題数');
            $table->integer('number_correct_answers')->comment('正解数');
            $table->integer('mark')->comment('得点');
            // $table->time('time_attack', 2)->nullable()->comment('タイムアタック');
            $table->decimal('time_attack', 5, 2)->nullable()->comment('タイムアタック');
            $table->integer('best_time_flag')->nullable()->comment('ベストタイムフラグ（０：ベストタイムでない、１：ベストタイムである）');
			$table->softDeletes();
            $table->timestamps();

            //外部キー制約
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
