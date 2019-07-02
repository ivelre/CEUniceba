<?php

use Illuminate\Database\Seeder;

class TiposPlanesEspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("tipos_planes_especialidades")->insert([ "id" => 1, "tipo_plan_especialidad" => "Semestral" ]);
        DB::table("tipos_planes_especialidades")->insert([ "id" => 2, "tipo_plan_especialidad" => "Cuatrimestral" ]);
        DB::table("tipos_planes_especialidades")->insert([ "id" => 3, "tipo_plan_especialidad" => "Bimestral" ]);
    }
}
