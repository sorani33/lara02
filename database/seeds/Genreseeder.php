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
            'genre_id' => 1,
            'genre_subject_id' => 1,
            'name'    => '世界史2019',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
