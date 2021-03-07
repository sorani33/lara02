<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Genreseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('genres')->insert([
            'subject'    => '世界史2019',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
