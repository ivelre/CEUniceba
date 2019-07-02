<?php

use Faker\Generator as Faker;

$factory->define(App\Models\TipoExamen::class, function (Faker $faker) {
    return [
			'tipo_examen' => $faker->unique()->sentence(3)
    ];
});
