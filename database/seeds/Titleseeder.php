<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Titleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('titles')->insert([
            ['name' => 'ポトフ','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'おはしゃぎ','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => '廊下の人','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => '前言撤回','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'Life is a Festival','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'モテ警察','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'fire','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name' => 'アーカイブ勢','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
        ]);

    }
}
