<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';
    
    protected $fillable = [
    	'nivel_academico_id','clave','especialidad','reconocimiento_oficial','dges','fecha_reconocimiento','descripcion','modalidad_id','tipo_plan_especialidad_id'
    ];

    static function getEspecialidades(){
        return \DB::table('especialidades')
            ->join('niveles_academicos','niveles_academicos.id','especialidades.nivel_academico_id')
            ->join('planes_especialidades','planes_especialidades.especialidad_id','especialidades.id')
            ->get();
    }

    public $timestamps = false;

    public function planes_especialidades(){
        return $this->hasMany('App\Models\PlanEspecialidad','especialidad_id');
    }

    public function clases(){
        return $this->hasMany('App\Models\Clase','especialidad_id');
    }

    public function nivel_academico(){
    	return $this->belongsTo('App\Models\NivelAcademico','nivel_academico_id');
    }

    public function modalidad(){
        return $this->belongsTo('App\Models\ModalidadEspecialidad','modalidad_id');
    }

    public function tipo_plan_especialidad(){
        return $this->belongsTo('App\Models\TipoPlanEspecialidad','tipo_plan_especialidad_id');
    }
}
