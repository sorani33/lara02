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
        DB::table('examination_questions')->insert([
            ['no' => '1','name' => '業務テスト１','email' => 'test1@gmail.com','email_verified_at' => NULL,'password' => 'mudamuda','class_id' => 1,'title_id' => '1','rememberToken' =>NULL,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
        ]);
    }
}
