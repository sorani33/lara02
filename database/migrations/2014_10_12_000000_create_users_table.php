<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('名前');
            $table->integer('class_id')->nullable()->default(5)->comment('クラスID');
            $table->integer('title_id')->nullable()->comment('称号ID');
            $table->string('avatar')->nullable()->comment('名前');
            $table->string('email')->unique()->comment('eメール');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
