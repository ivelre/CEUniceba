<?php

use Illuminate\Database\Seeder;

class ModalidadesEstudiantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("modalidades_estudiantes")->insert([ "id" => 1, "modalidad_estudiante" => "Normal" ]);
        DB::table("modalidades_estudiantes")->insert([ "id" => 2, "modalidad_estudiante" => "Equiparación" ]);
        DB::table("modalidades_estudiantes")->insert([ "id" => 3, "modalidad_estudiante" => "Equivalencia" ]);
    }
}
