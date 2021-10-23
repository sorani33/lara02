<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_genres', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('サブジャンルID');
            $table->integer('genre_id')->comment('ジャンルID');
            $table->string('name', 100)->comment('名前');
            $table->string('url', 100)->comment('URL');
			$table->softDeletes();
            $table->timestamps();

            $table->foreign('genre_id')
                    ->references('id')
                    ->on('genres')
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
        Schema::dropIfExists('sub_genres');
    }
}
