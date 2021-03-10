<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class UserTitleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_titles')->insert([
            ['user_id' => '1','title_id' => '1','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['user_id' => '1','title_id' => '3','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
        ]);

    }
}
