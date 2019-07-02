<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $table = 'clases';
    
    protected $fillable = [
    	'asignatura_id','turno','clase','docente_id','periodo_id','especialidad_id'
    ];

    public $timestamps = false;

    public function horarios(){
    	return $this->hasMany('App\Models\Horario','clase_id');
    }

    public function grupos(){
    	return $this->hasMany('App\Models\Grupo','clase_id');
    }

    public function asignatura(){
    	return $this->belongsTo('App\Models\Asignatura','asignatura_id');
    }

    public function docente(){
    	return $this->belongsTo('App\Models\Docente','docente_id');
    }

    public function periodo(){
    	return $this->belongsTo('App\Models\Periodo','periodo_id');
    }

    public function especialidad(){
        return $this->belongsTo('App\Models\Especialidad','especialidad_id');
    }

    static function getDatosClase($id){
        return \DB::table('clases')
            ->where('clases.id', $id)
            ->select('asignatura','clases.asignatura_id','creditos','asignaturas.codigo','nombre','apaterno','amaterno','periodo_reticula','plan_especialidad','especialidad','nivel_academico','periodo','clase','fechas_examenes.fecha_inicio','modalidad_id','reticulas.id as reticula_id','dia_id','hora_entrada','hora_salida','turno','periodos.reconocimiento_oficial')
            ->leftjoin('horarios','horarios.clase_id','clases.id')
            ->join('asignaturas','asignaturas.id','clases.asignatura_id')
            ->join('docentes','docentes.id','clases.docente_id')
            ->join('datos_generales','datos_generales.id','docentes.dato_general_id')
            ->join('reticulas','reticulas.asignatura_id','asignaturas.id')
            ->join('planes_especialidades','planes_especialidades.id','reticulas.plan_especialidad_id')
            ->join('especialidades','especialidades.id','planes_especialidades.especialidad_id')
            ->join('niveles_academicos','niveles_academicos.id','especialidades.nivel_academico_id')
            ->join('periodos','periodos.id','clases.periodo_id')
            ->join('fechas_examenes','fechas_examenes.periodo_id','periodos.id')
            ->where('tipo_examen_id',1)
            ->first();
    }

    static function getSerializacion($reticula_id){
        $codigo = \DB::table('asignaturas')
            ->select('asignaturas.codigo')
            ->join('reticulas','reticulas.asignatura_id','asignaturas.id')
            ->join('requisitos_reticulas','requisitos_reticulas.reticula_requisito_id','reticulas.id')
            ->where('reticula_id', $reticula_id)
            ->first();
        if($codigo)
            return $codigo -> codigo;
        return null;
    }
}
