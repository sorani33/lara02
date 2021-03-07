<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExaminationQuestionseeder extends Seeder
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
            ['no' => '1','genre_id' => '1','subject' => '猫はどれですか','answer' => 'ねこ','dummy_answer1' => 'ぽち','dummy_answer2' => 'さる','dummy_answer3' => 'きじ','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '2','genre_id' => '1','subject' => '犬はどれですか','answer' => 'ねこ','dummy_answer1' => 'ぽち','dummy_answer2' => 'さる','dummy_answer3' => 'きじ','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
        ]);
    }
}
