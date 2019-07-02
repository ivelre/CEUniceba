<?php

use Illuminate\Database\Seeder;

class ModalidadesEspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("modalidades_especialidades")->insert([ "id" => 1, "modalidad_especialidad" => "Sabatina" ]);
        DB::table("modalidades_especialidades")->insert([ "id" => 2, "modalidad_especialidad" => "Semanal" ]);
    }
}
