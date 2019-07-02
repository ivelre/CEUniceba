<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Asignatura::class, function (Faker $faker) {
    return [
        'codigo'			=> $faker->unique()->isbn13,
        'asignatura' 	=> $faker->unique()->sentence(2),
        'creditos' 		=> rand(1,5)
    ];
});
