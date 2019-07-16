<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataTable extends Model
{
    static function estudiantes(){
    	return \DB::table('vw_estudiantes');
  	}

  	static function fechas_examenes($periodo_id){
    	return \DB::table('vw_fechas_examenes')->where('periodo_id',$periodo_id)->get();
  	}

		static function especialidades(){
	    return \DB::table('vw_especialidades')->orderBy('id','desc')->get();
	  }  	

	  /**
	   * Regresa la lista de docentes con el último periodo activo en el que impartió clases
	   * @return Array docentes
	  */
	  static function docentes(){
	  	$docentes = Docente::query();
	  	$docentes->orderBy('id', 'desc');
	  	$docentes->with(['dato_general', 'clases' => function ($query) {
		  	$query->with(['periodo' => function ($query) {
		  		$query->max('id');
		  	}]);
	  	}]);

	  	$respuesta = [];

	  	$docentes->each(function ($item, $key) use (&$respuesta) {
    		$respuesta[] = (Object) [
    			'id' => $item -> id,
					'docente_id' => $item-> id, //: "697",
					'codigo' => $item-> codigo, //: "CAHL",
					'nombre' => $item-> dato_general -> nombre, //: "CESAR ANTONIO",
					'apaterno' => $item-> dato_general -> apaterno, //: "HERNANDEZ",
					'amaterno' => $item-> dato_general -> amaterno, //: "LEON",
					'fecha_nacimiento' => $item-> dato_general -> fecha_nacimiento, //: "2019-07-08",
					'telefono_casa' => $item-> dato_general -> telefono_casa, //: null,
					'rfc' => $item-> rfc, //: "CAHL",
					'titulo' => $item-> titulo -> titulo, //: "MAESTRIA",
					'periodo' => $item-> clases -> map(function($item, $key) {
							return $item->periodo;
						})->max('periodo'), //: "20/1"
    		];
			});

	  	return ($respuesta);

	  	// dd(collect($respuesta)->take(10));
	  	// dd(collect($respuesta)->groupBy('periodo'));

	  	$docentes = \DB::table('vw_docentes')->orderBy('docente_id','desc')->get();
	  	foreach ($docentes as $key => $docente) {
	  		$periodo_id =\DB::table('clases')
	  									->select(\DB::raw('MAX(periodo_id) as periodo_id'))
	  									->where('docente_id',$docente -> docente_id)
	  									->first();
				if(isset($periodo_id -> periodo_id)){
	  			$periodo = \DB::table('periodos')->where('id',$periodo_id -> periodo_id)->first();
	  			$docentes[$key] -> periodo = $periodo -> periodo;
				}else
	  			$docentes[$key] -> periodo = null;
	  	}
	    return $docentes;
	  }

	  static function clases($periodo_id,$especialidad_id){
	    return \DB::table('vw_clases')->where([
	    	['periodo_id',						$periodo_id],
	    	['especialidad_id',	$especialidad_id]
	    ])->get();
	  }

	  static function kardex($estudiante_id){
	    return \DB::table('vw_kardex')->where('estudiante_id',$estudiante_id)->orderBy('semestre','asc')->get();
	  }

	  static function grupos($clase_id){
	    return \DB::table('vw_grupos')->where('clase_id',$clase_id)->orderBy('clase_id','asc')->get();
	  }
}
