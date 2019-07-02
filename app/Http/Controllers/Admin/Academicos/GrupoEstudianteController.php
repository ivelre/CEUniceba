<?php

namespace App\Http\Controllers\Admin\Academicos;

use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Clase;
use App\Models\Oportunidad;
use App\Models\Kardex;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GrupoEstudianteController extends Controller
{
    public function get(Request $request){

    	$response = null;

    	$estudiante = Estudiante::where([
    		['matricula',$request->matricula],
    		['especialidad_id',$request->especialidad_id]
    	])->first();

    	if ($estudiante) {

        $clase = Clase::find($request->clase_id);

        $clases_grupos = Clase::where([
            ['asignatura_id',$clase->asignatura_id],
            ['periodo_id',$clase->periodo_id],
            ['especialidad_id',$clase->especialidad_id],
        ])->get();

        $match = false;

        foreach ($clases_grupos as $key => $clase_grupo) {
            $estudiante_grupo = Grupo::where([
                ['clase_id',$clase_grupo->id],
                ['estudiante_id',$estudiante->id]
            ])->first();

            if ($estudiante_grupo) {
                $match = true;
            }
        }

    		if (!$match) {
    			
    			$reticulas = $estudiante->plan_especialidad->reticulas;

    			$match_asignatura = false;

    			foreach ($reticulas as $key => $reticula) {
    				if ($reticula->asignatura_id == $clase->asignatura_id) {
    					$match_asignatura = true;
    				}
    			}

    			if($match_asignatura){

    				$kardexs = Kardex::where([
							['estudiante_id',$estudiante->id],
							['asignatura_id',$clase->asignatura_id]
						])->get();

	    			$oportunidades = Oportunidad::get();

					if( sizeof($kardexs) < sizeof($oportunidades) ){

						$valid = true;
						foreach ($kardexs as $key => $kardex) {
							if ($kardex->calificacion >= 7) {
								$valid = false;
							}
						}

						if($valid){

							$no_oportunidad = sizeof($kardexs) + 1;
							$oportunidad = Oportunidad::find($no_oportunidad);
							$dato_general = $estudiante->dato_general;

  						$response['estudiante_id'] = $estudiante->id;
                        $response['semestre'] = $estudiante->semestre;
                        // $response['calificacion'] = $estudiante->calificacion;
  						$response['nombre'] = $dato_general->nombre.' '.$dato_general->apaterno.''.$dato_general->amaterno;
  						$response['oportunidad_id'] = $oportunidad->id;
  						$response['oportunidad'] = $oportunidad->oportunidad;
								
						}else{
              $response['error'] = 'El estudiante ya aprobó la materia';
            }

					}else{
            $response['error'] = 'El estudiante ya súpero el número de oportunidades';
          }

    		}else{
        	$response['error'] = 'El estudiante no cuenta con la materia en su plan de estudios';
        }

    	}else{
        $response['error'] = 'El estudiante ya está inscrito';
      }

    }else{
      $response['error'] = 'El estudiante no pertenece a la especialidad';
    }

    return $response;
  }
}
