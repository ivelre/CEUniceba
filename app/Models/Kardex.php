<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    protected $table = 'kardexs';
    
    protected $fillable = [
        'estudiante_id','asignatura_id','oportunidad_id','semestre','periodo_id','grupo_id','calificacion'

    ];

    public $timestamps = false;

    public function estudiante(){
    	return $this->belongsTo('App\Models\Estudiante','estudiante_id');
    }

    public function asignatura(){
    	return $this->belongsTo('App\Models\Asignatura','asignatura_id');
    }

    public function oportunidad(){
    	return $this->belongsTo('App\Models\Oportunidad','oportunidad_id');
    }

    public function periodo(){
    	return $this->belongsTo('App\Models\Periodo','periodo_id');
    }

    static function getCalificacionAlumno($asignatura_id,$estudiante_id){
        return \DB::table('kardexs')
                ->where('asignatura_id',$asignatura_id)
                ->where('estudiante_id',$estudiante_id)
                ->first();
    }

    static function getBoleta($estudiante_id,$periodo_id,$oportunidad_id){
        return \DB::table('kardexs')
                ->join('asignaturas','asignaturas.id','kardexs.asignatura_id')
                ->where('estudiante_id',$estudiante_id)
                ->where('periodo_id',$periodo_id)
                ->where('oportunidad_id',$oportunidad_id)
                ->get();
    }

    static function getPromedioBoleta($estudiante_id,$periodo_id,$oportunidad_id){
        return \DB::table('kardexs')
                ->select(\DB::raw('ROUND(AVG(calificacion),1) as promedio'))
                ->where('estudiante_id',$estudiante_id)
                ->where('periodo_id',$periodo_id)
                ->where('oportunidad_id',$oportunidad_id)
                ->first();
    }

    static function getEstudiantesXPeriodo($periodo_id,$oportunidad_id){
        return \DB::table('kardexs')
                ->select('matricula',\DB::raw("CONCAT(apaterno , ' ' , amaterno , ' ' , nombre ) AS nombre"),\DB::raw("CONCAT(nivel_academico , ' en ' , especialidad ) AS especialidad"),'estudiantes.id as id')
                ->join('asignaturas','asignaturas.id','kardexs.asignatura_id')
                ->join('estudiantes','estudiantes.id','kardexs.estudiante_id')
                ->join('datos_generales','datos_generales.id','estudiantes.dato_general_id')
                ->join('especialidades','especialidades.id','estudiantes.especialidad_id')
                ->join('niveles_academicos','niveles_academicos.id','especialidades.nivel_academico_id')
                ->where('kardexs.periodo_id',$periodo_id)
                ->where('kardexs.oportunidad_id',$oportunidad_id)
                ->groupBy('kardexs.estudiante_id')
                ->orderBy('matricula','asc')
                ->get();
    }
}
