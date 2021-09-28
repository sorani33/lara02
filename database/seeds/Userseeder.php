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
        
        DB::table('users')->insert([
            ['name' => '業務テスト１','email' => 'test1@gmail.com','email_verified_at' => NULL,'password' => 'mudamuda','token' =>NULL,'avatar' =>NULL,'class_id' => 1,'title_id' => '1','remember_token' =>NULL,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => '業務テスト２','email' => 'test2@gmail.com','email_verified_at' => NULL,'password' => 'mudamuda','token' =>NULL,'avatar' =>NULL,'class_id' => 2,'title_id' => '1','remember_token' =>NULL,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => '業務テスト３','email' => 'test3@gmail.com','email_verified_at' => NULL,'password' => 'mudamuda','token' =>NULL,'avatar' =>NULL,'class_id' => 3,'title_id' => '1','remember_token' =>NULL,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => '業務テスト４','email' => 'test4@gmail.com','email_verified_at' => NULL,'password' => 'mudamuda','token' =>NULL,'avatar' =>NULL,'class_id' => 4,'title_id' => '1','remember_token' =>NULL,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
        ]);
    }
}
