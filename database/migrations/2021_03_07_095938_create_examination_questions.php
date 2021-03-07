<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no')->comment('数値');
            $table->integer('genre_id')->comment('ジャンルID');
            $table->string('subject', 255);
            $table->string('answer', 255);
            $table->string('dummy_answer1', 255);
            $table->string('dummy_answer2', 255);
            $table->string('dummy_answer3', 255);
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
        Schema::dropIfExists('examination_questions');
    }
}
