<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            ['name' => '業務テスト１','email' => 'test1@gmail.com','email_verified_at' => NULL,'password' => 'mudamuda','class_id' => 1,'title_id' => '1','remember_token' =>NULL,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
        ]);
    }
}
