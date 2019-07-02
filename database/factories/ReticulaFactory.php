<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reticula::class, function (Faker $faker) {
    return [
        'plan_especialidad_id'	=> 1,
        'asignatura_id'					=> rand(1,200),
        'periodo_reticula' => 1
    ];
});
