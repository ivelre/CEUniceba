<?php

namespace App\Http\Controllers\Admin\Escolares;

use App\Models\PlanEspecialidad;
use App\Models\Reticula;
use App\Models\RequisitoReticula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsignaturaReticulaController extends Controller
{
    public function asignaturas_periodo(Request $request){
    	$response = [];
			$plan_especialidad = PlanEspecialidad::find($request->plan_especialidad_id);
			$asignaturas  = $plan_especialidad->asignaturas;
			foreach ($asignaturas as $key => $asignatura) {
				if($asignatura->pivot->periodo_reticula == $request->periodo_reticula){
					$pivot = $asignatura->pivot;
					$reticula = Reticula::where([
						['plan_especialidad_id',$pivot->plan_especialidad_id],
						['asignatura_id',$pivot->asignatura_id],
						['periodo_reticula',$pivot->periodo_reticula]
					])->first();
					$asignatura->reticula = $reticula->id;
					array_push($response,$asignatura);
				}
			}
      return $response;
    }

    public function asignaturas_requisito($reticula_id){
    	$response = [];
			$reticula = Reticula::find($reticula_id);
			$asignaturas_requisito = $reticula->requisitos;

			
			foreach ($asignaturas_requisito as $key => $asignatura_requisito){
				
				$asignatura = $asignatura_requisito->asignatura;
				$asignatura->periodo_reticula = $asignatura_requisito->periodo_reticula;

				$pivot = $asignatura_requisito->pivot;
				$requisito = RequisitoReticula::where([
					['reticula_id',$pivot->reticula_id],
					['reticula_requisito_id',$pivot->reticula_requisito_id]
				])->first();
				$asignatura->requisito = $requisito->id;
				array_push($response,$asignatura);
			}
      return $response;
    }
}
