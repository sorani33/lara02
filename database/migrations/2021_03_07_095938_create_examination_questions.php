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
            $table->integer('genre_id')->comment('ジャンルID');
            $table->integer('sub_genre_id')->comment('サブジャンルID');
            $table->string('subject', 255)->comment('問題');
            $table->string('answer', 255)->comment('解答');
            $table->string('dummy_answer1', 255)->comment('ダミー回答1');
            $table->string('dummy_answer2', 255)->comment('ダミー回答2');
            $table->string('dummy_answer3', 255)->comment('ダミー回答3');
            $table->string('url', 255)->comment('URL');
			$table->softDeletes();
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
