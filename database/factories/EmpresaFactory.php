<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Empresa::class, function (Faker $faker) {
    return [
        'empresa'		=>  $faker->unique()->company,
        'direccion'	=> $faker->address
    ];
});
