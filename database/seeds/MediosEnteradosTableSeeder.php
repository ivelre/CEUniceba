<?php

use Illuminate\Database\Seeder;

class MediosEnteradosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("medios_enterados")->insert([ "id" => 1, "medio_enterado" => "Estudiante" ]);
        DB::table("medios_enterados")->insert([ "id" => 2, "medio_enterado" => "Maestro" ]);
        DB::table("medios_enterados")->insert([ "id" => 3, "medio_enterado" => "Recomendación" ]);
        DB::table("medios_enterados")->insert([ "id" => 4, "medio_enterado" => "Visita a mi empresa" ]);
        DB::table("medios_enterados")->insert([ "id" => 5, "medio_enterado" => "Visita a mi escuela" ]);
    }
}