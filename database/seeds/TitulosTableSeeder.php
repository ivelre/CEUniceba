<?php

use Illuminate\Database\Seeder;

class TitulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("titulos")->insert([ "id" => 1, "titulo" => "Licenciatura" ]);
        DB::table("titulos")->insert([ "id" => 2, "titulo" => "Maestria" ]);
        DB::table("titulos")->insert([ "id" => 3, "titulo" => "Doctorado" ]);
    }
}
