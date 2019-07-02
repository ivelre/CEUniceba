<?php

use Illuminate\Database\Seeder;

class EstadosTitulacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("estados_titulaciones")->insert([ "id" => 1, "estado_titulacion" => "Solicitud" ]);
        DB::table("estados_titulaciones")->insert([ "id" => 2, "estado_titulacion" => "En curso" ]);
        DB::table("estados_titulaciones")->insert([ "id" => 3, "estado_titulacion" => "Finalizado" ]);
    }
}
