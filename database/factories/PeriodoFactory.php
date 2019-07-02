<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Periodo::class, function (Faker $faker) {
    return [
        'anio'										=> $faker->year($max = 'now'),
        'periodo'									=> $faker->unique()->word,
        'reconocimiento_oficial'	=> $faker->unique()->isbn13,
        'dges'										=> $faker->unique()->isbn13,
        'fecha_reconocimiento'		=> $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});
