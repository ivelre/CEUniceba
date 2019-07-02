<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PlanEspecialidad::class, function (Faker $faker) {
    return [
        'plan_especialidad'	=> $faker->unique()->sentence(1),
        'periodos'					=> rand(6,9),
        'especialidad_id'		=> 1,
    ];
});
