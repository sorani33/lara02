<?php

use Illuminate\Database\Seeder;

class ExaminationResultseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\ExaminationResult::class, 10)->create();
    }
}
