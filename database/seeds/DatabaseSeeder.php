<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ExaminationQuestionseeder::class);

        // $this->call(Userseeder::class);
        // $this->call(Titleseeder::class);
        // $this->call(Genreseeder::class);
        // $this->call(UserTitleseeder::class);
        
    }
}
