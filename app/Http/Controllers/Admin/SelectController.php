<?php

namespace App\Http\Controllers\Admin;

use App\Models\Especialidad;
use App\Models\PlanEspecialidad;
use App\Models\Reticula;
use App\Models\Asignatura;
use App\Models\Localidad;
use App\Models\Municipio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectController extends Controller
{

    /**
     * Regresa las especialidades del nivel académico especifíco.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request  $request   - Nivel académico
     * @return \Illuminate\Http\Response            - Especialidades el nivel académico
     */
    public function especialidades_nivel(Request $request){
    	$especialidades = Especialidad::where('nivel_academico_id',$request->nivel_academico_id)->get();
    	return $especialidades;
    }

    /**
     * Regresa los planes académicos de una especialidad.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request  $request   - Especialidad
     * @return \Illuminate\Http\Response            - Planes académicos
     */
    public function planes_especialidades(Request $request){
        $planes_especialidades = PlanEspecialidad::where('especialidad_id',$request->especialidad_id)->get();
        return $planes_especialidades;
    }

    /**
     * Regresa la reticula de la especialidad.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request  $request   - Especialidad
     * @return \Illuminate\Http\Response            - Reticula de la especialidad
     */
    public function reticulas(Request $request){
    	$reticulas = Reticula::where('especialidad_id',$request->especialidad_id)->get();
    	return $reticulas;
    }

    /**
     * Regresa las asignaturas que pueden agregarse a una reticula y que estas no se encuentren 
     * ya agregadas.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request  $request   - Plan de estudios
     * @return \Illuminate\Http\Response            - Asignaturas
     */
	public function asignaturas_reticula(Request $request){
    	$response = [];
    	$plan_especialidad = PlanEspecialidad::find($request->plan_especialidad_id);
    	$asignaturas_plan = $plan_especialidad->asignaturas;
    	$asignaturas = Asignatura::get();

    	foreach ($asignaturas as $key => $asignatura) {
    		$find = false;
    		foreach ($asignaturas_plan as $key => $asignatura_plan) {
    			if($asignatura->id == $asignatura_plan->id){
    				$find = true;
    			}
    		}
    		if(!$find){
    			array_push($response,$asignatura);
    		}
    	}
    	return $response;
    }    

    /**
     * Asignaturas que estan en la reticula y pueden ser requisitos.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request  $request   - Asignatura (Retícula)
     * @return \Illuminate\Http\Response            - Asignaturas (Retículas)
     */
    public function asignaturas_requisito(Request $request){
        $response = [];

        $reticula = Reticula::find($request->reticula_id);
        $requisitos = $reticula->requisitos;

        $plan_especialidad = PlanEspecialidad::find($reticula->plan_especialidad_id);
        $asignaturas_plan = $plan_especialidad->asignaturas;

        foreach ($asignaturas_plan as $key => $asignatura_plan) {
            
            if($asignatura_plan->id != $reticula->asignatura_id){
                $pivot = $asignatura_plan->pivot;
                if($pivot->periodo_reticula < $reticula->periodo_reticula){
                    $match = false;
                    foreach ($requisitos as $key => $requisito) {
                        $asignatura_requisito = $requisito->asignatura;
                        if($asignatura_plan->id == $asignatura_requisito->id){
                            $match = true;
                        }
                    }
                    if(!$match){
                        $reticula_asignatura = Reticula::where([
                            ['plan_especialidad_id',$pivot->plan_especialidad_id],
                            ['asignatura_id',$pivot->asignatura_id],
                            ['periodo_reticula',$pivot->periodo_reticula]
                        ])->first();
                        $asignatura_plan->reticula = $reticula_asignatura->id;
                        array_push($response,$asignatura_plan);    
                    }
                }       
            }        
        }
        return $response;
    }

    /**
     * Regresa lo municipios de un estado especifíco.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request  $request   - Estado
     * @return \Illuminate\Http\Response            - Municipios
     */
    public function municipios(Request $request){
        $municipios = Municipio::where('estado_id',$request->estado_id)->orderBy('municipio','asc')->get();
        return $municipios;
    }

    /**
     * Regresa las localidades de un municipio especifíco.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request  $request   - Municipio
     * @return \Illuminate\Http\Response            - Localidades
     */
    public function localidades(Request $request){
        $localidades = Localidad::where('municipio_id',$request->municipio_id)->orderBy('localidad','asc')->get();
        return $localidades;
    }    
}
