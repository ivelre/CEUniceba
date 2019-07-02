<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Docente::class, function (Faker $faker) {
    return [
        'codigo'						=> $faker->unique()->isbn13,
        'dato_general_id'		=> 1,
        'rfc' 							=> $faker->unique()->isbn13,
        'titulo_id'         => rand(1,3),
        'usuario_id'        => 1
    ];
});
