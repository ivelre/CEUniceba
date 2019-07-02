<?php

use Illuminate\Database\Seeder;

class NivelesAcademicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("niveles_academicos")->insert([ "id" => 1, "nivel_academico" => "Licenciatura" ]);
        DB::table("niveles_academicos")->insert([ "id" => 2, "nivel_academico" => "Maestría" ]);
        DB::table("niveles_academicos")->insert([ "id" => 3, "nivel_academico" => "Doctorado" ]);
    }
}
