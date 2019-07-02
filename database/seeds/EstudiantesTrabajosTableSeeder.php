<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Estudiante;

class EstudiantesTrabajosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
        $estudiantes = Estudiante::get();
        foreach ($estudiantes as $key => $estudiante) {
        	
        	$empresa_id = rand(1,51);
        	if ($empresa_id == 1) {
        		$estudiante->empresa()->attach($empresa_id);
        	}else{
        		$estudiante->empresa()->attach($empresa_id,[
        			'puesto' => $faker->word
        		]);
        	}

        }

    }
}
