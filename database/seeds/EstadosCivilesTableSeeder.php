<?php

use Illuminate\Database\Seeder;

class EstadosCivilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("estados_civiles")->insert([ "id" => 1, "estado_civil" => "Soltero" ]);
        DB::table("estados_civiles")->insert([ "id" => 2, "estado_civil" => "Casado" ]);
        DB::table("estados_civiles")->insert([ "id" => 3, "estado_civil" => "Divorciado" ]);
        DB::table("estados_civiles")->insert([ "id" => 4, "estado_civil" => "Unión libre" ]);
    }
}
