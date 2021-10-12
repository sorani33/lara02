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
        // php artisan db:seed

        // $this->call(UsersTableSeeder::class);
        // xlsx管理ここから
        $this->call(ExaminationQuestionseeder::class);
        $this->call(Genreseeder::class);
        $this->call(SubGenreseeder::class);
        // xlsx管理ここまで

        // テストデータここから
        // $this->call(Userseeder::class);
        // $this->call(ExaminationResultseeder::class); //herokuだとなぜかエラーになる
        // $this->call(Titleseeder::class);
        // $this->call(UserTitleseeder::class);
        // テストデータここまで
        
    }
}
