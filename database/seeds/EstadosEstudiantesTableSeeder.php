<?php

use Illuminate\Database\Seeder;

class EstadosEstudiantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("estados_estudiantes")->insert([ "id" => 1, "estado_estudiante" => "Inscrito" ]);
        DB::table("estados_estudiantes")->insert([ "id" => 2, "estado_estudiante" => "Reinscrito" ]);
        DB::table("estados_estudiantes")->insert([ "id" => 3, "estado_estudiante" => "Baja temporal" ]);
        DB::table("estados_estudiantes")->insert([ "id" => 4, "estado_estudiante" => "Baja definitiva" ]);
    }
}
