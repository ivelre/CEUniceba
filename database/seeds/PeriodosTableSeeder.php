<?php

use Illuminate\Database\Seeder;

class PeriodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		for ($i=0; $i < 15; $i++) { 
    			if ($i%2 == 0) {
    				factory(App\Models\Periodo::class,1)->create([
    					'anio'		=>	(2000+$i),
						'periodo'	=> 'Febrero - Junio',
						'jefe_control' => 'N/A',
						'director' => 'N/A'
        		]);
    			}else{
    				factory(App\Models\Periodo::class,1)->create([
    					'anio' 		=> (2000+$i),
						'periodo' => 'Agosto - Diciembre',
						'jefe_control' => 'N/A',
						'director' => 'N/A'
        		]);
    			}
    		}
    }
}
