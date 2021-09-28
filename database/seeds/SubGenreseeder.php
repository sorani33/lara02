<?php

use Illuminate\Database\Seeder;

class SubGenreseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        seederByXlsx('SubGenre','sub_genres');

    }
}
