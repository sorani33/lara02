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
            $table->integer('number_questions');
            $table->integer('number_correct_answers');
            $table->integer('mark');
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
