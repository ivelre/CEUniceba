<?php

use Illuminate\Database\Seeder;
use App\Models\PlanEspecialidad;
use App\Models\Reticula;
use App\Models\RequisitoReticula;

class RequisitosReticulasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $reticulas_ant = [];
      $planes_especialidades = PlanEspecialidad::get();
      foreach ($planes_especialidades as $key => $plan_especialidad) {
      	
        $reticulas = $plan_especialidad->reticulas;
      	
      	foreach ($reticulas as $key => $reticula) {

    		 	
    		 	//Asignaturas Anteriores
    		 	foreach ($reticulas as $key_ant => $reticula_ant) {
    		 		if($reticula_ant->id != $reticula->id ){
    		 			if($reticula_ant->periodo_reticula < $reticula->periodo_reticula){
    		 				array_push($reticulas_ant,$reticula_ant);
    		 			}
    		 		}
    			}

          //Si en encuentra materias anteriores
    			if(count($reticulas_ant)>0){
    				
    				$ini = count($reticulas_ant)-3;
    				$fin = count($reticulas_ant);

						if($ini<0){
							$ini=0;
						}
						
    				for ($i=$ini; $i < $fin; $i++) { 
    					
    					$reticula_requisito = $reticulas_ant[$i];

              if($reticula->periodo_reticula > $reticula_requisito->periodo_reticula)

    					RequisitoReticula::create([
			        	'reticula_id'						=> $reticula->id,
			        	'reticula_requisito_id'	=> $reticula_requisito->id
			        ]);
    				}
    			}
      	}
      }
    }
}
