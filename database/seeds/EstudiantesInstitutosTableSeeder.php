<?php

use Illuminate\Database\Seeder;
use App\Models\Estudiante;

class EstudiantesInstitutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estudiantes = Estudiante::get();
        foreach ($estudiantes as $key => $estudiante) {
        	$estudiante->instituto_procedencia()->attach(rand(1,33));
        }
    }
}
