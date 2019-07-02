<?php

use Illuminate\Database\Seeder;
use App\Models\Periodo;

class FechasExamenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$periodos = Periodo::get();
        foreach ($periodos as $key => $periodo) {
        	factory(App\Models\FechaExamen::class,4)->create([
      			'periodo_id' => $periodo->id
      		]);
        }
    }
}
