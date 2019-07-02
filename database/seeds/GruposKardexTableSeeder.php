<?php

use Illuminate\Database\Seeder;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Kardex;
use App\Models\Clase;

class GruposKardexTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estudiantes = Estudiante::get();

        foreach ($estudiantes as $key_estudiante => $estudiante) {
        	
        	$plan_especialidad = $estudiante->plan_especialidad;

        	$periodos_plan = $plan_especialidad->periodos;

        	$reticulas = $plan_especialidad->reticulas;

        	for ($i=1; $i <= $periodos_plan; $i++) { 
        		
        		$estudiante->semestre = $i;
        		$estudiante->save();

        		foreach ($reticulas as $key_asignatura => $reticula) {
        			
        			if($reticula->periodo_reticula <= $i){

        				$requisitos = $reticula->requisitos;

        				$kardexs = $estudiante->kardexs;

        				$valid = true;

        				foreach ($requisitos as $key_requisito => $requisito) {

									$kardexs = Kardex::where([
										['estudiante_id',$estudiante->id],
										['asignatura_id',$requisito->asignatura_id]
									])->get();

									if($kardexs){
										$max_calificacion = 0;

										foreach ($kardexs as $key_kardex => $kardex) {
											if($kardex->calificacion >= $max_calificacion){
												$max_calificacion = $kardex->calificacion;
											}
										}

										if ($max_calificacion >= 7) {
											$valid = false;
										}

									}else{
										$valid = false;
									}

        				}

        				if($valid){

        					$kardexs = Kardex::where([
										['estudiante_id',$estudiante->id],
										['asignatura_id',$reticula->asignatura_id]
									])->get();

									if(sizeof($kardexs)<3){

										$valid = true;
										foreach ($kardexs as $key => $kardex) {
											if ($kardex->calificacion >= 7) {
												$valid = false;
											}
										}

										if($valid){

											$clases = Clase::where([
												['asignatura_id',$reticula->asignatura_id],
												['especialidad_id',$estudiante->especialidad_id],
												['periodo_id',$i],
											])->get();

											$no_clases = sizeof($clases);

											if ($no_clases>0) {
												
												$clase = $clases[rand(0,$no_clases-1)];

												$no_oportunidad = sizeof($kardexs) + 1;

												Grupo::create([
									      	'clase_id'				=> $clase->id,
									      	'estudiante_id'		=> $estudiante->id,
									        'oportunidad_id'	=> $no_oportunidad
									      ]);



									      Kardex::create([
									      	'estudiante_id'		=> $estudiante->id,
									      	'asignatura_id'		=> $reticula->asignatura_id,
									        'oportunidad_id'	=> $no_oportunidad,
									        'semestre' 				=> $estudiante->semestre,
									        'periodo_id' 			=> $i,
									        'calificacion'		=> rand(0,10)
									      ]);

											}

										}

									}

        				}

        			}

        		}

        	}

        }
    }
}
