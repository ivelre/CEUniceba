<?php

use Faker\Generator as Faker;

$factory->define(App\Models\FechaExamen::class, function (Faker $faker) {
    return [
        'tipo_examen_id'	=> rand(1,5),
        'fecha_inicio'		=> $faker->date($format = 'Y-m-d', $max = 'now'),
        'fecha_final'			=> $faker->date($format = 'Y-m-d', $max = 'now'),
        'periodo_id'			=> 1
    ];
});
