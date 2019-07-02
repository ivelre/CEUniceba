<?php

use Illuminate\Database\Seeder;

class DiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table("dias")->insert([ "id" => 1, "dia" => "Lunes" ]);
      DB::table("dias")->insert([ "id" => 2, "dia" => "Martes" ]);
      DB::table("dias")->insert([ "id" => 3, "dia" => "Miércoles" ]);
      DB::table("dias")->insert([ "id" => 4, "dia" => "Jueves" ]);
      DB::table("dias")->insert([ "id" => 5, "dia" => "Viernes" ]);
      DB::table("dias")->insert([ "id" => 6, "dia" => "Sábado" ]);
    }
}
