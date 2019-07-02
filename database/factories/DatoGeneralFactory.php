<?php

use Faker\Generator as Faker;

$factory->define(App\Models\DatoGeneral::class, function (Faker $faker) {
    return [
    	'curp'              => $faker->unique()->isbn13,
        'nombre'            => $faker->firstName,
        'apaterno'          => $faker->lastName,
        'amaterno'          => $faker->lastName,
        'fecha_nacimiento'  => $faker->date($format = 'Y-m-d', $max = 'now'),
        'calle_numero'      => $faker->streetAddress,
        'colonia'           => $faker->streetName,
        'codigo_postal'     => $faker->buildingNumber,
        'localidad_id'      => rand(94493,94517),
        'telefono_personal' => $faker->tollFreePhoneNumber,
        'telefono_casa'     => $faker->tollFreePhoneNumber,
        'estado_civil_id'   => rand(1,4),
        'sexo'              => $faker->randomElement(['F','M','O']),
        'fecha_registro'    => date("Y-m-d"),
        'nacionalidad_id'   => 104,
        'email'             => $faker->unique()->email,
        'foto'              => $faker->unique()->imageUrl($width = 640, $height = 480, 'people')
    ];
});
