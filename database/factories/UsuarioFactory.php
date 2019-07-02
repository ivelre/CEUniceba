<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Usuario::class, function (Faker $faker) {
    return [
        'email' 		=> $faker->unique()->safeEmail,
        'password' 	=> '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'rol_id' 		=> rand(2,3)
    ];
});
