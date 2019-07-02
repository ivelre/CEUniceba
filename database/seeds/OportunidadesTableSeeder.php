<?php

use Illuminate\Database\Seeder;

class OportunidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("oportunidades")->insert([ "id" => 1, "oportunidad" => "Normal" ]);
        DB::table("oportunidades")->insert([ "id" => 2, "oportunidad" => "Repeticion" ]);
        DB::table("oportunidades")->insert([ "id" => 3, "oportunidad" => "Especial" ]);
    }
}
