<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\ExaminationResult::class, function (Faker $faker) {
    return [
        //
        'user_id' => $faker->numberBetween($min = 1, $max = 4),
        'genre_id' => $faker->numberBetween($min = 1, $max = 3),
        'gamemode' => $faker->numberBetween($min = 1, $max = 2),
        'number_questions' => 3,
        'number_correct_answers' => $faker->numberBetween($min = 1, $max = 3),
        'mark' => 100,
        // 'time_attack' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
        // 'best_time_flag' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get())
    ];
});
