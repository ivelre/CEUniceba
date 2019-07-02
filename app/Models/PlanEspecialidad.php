<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanEspecialidad extends Model
{
	protected $table = 'planes_especialidades';
    
    protected $fillable = [
    	'plan_especialidad','periodos','descripcion','especialidad_id'
    ];
    
    public $timestamps = false;

    public function reticulas(){
    	return $this->hasMany('App\Models\Reticula','plan_especialidad_id');
    }

    public function estudiantes(){
    	return $this->hasMany('App\Models\Estudiante','plan_especialidad_id');
    }

    public function asignaturas(){
        return $this->belongsToMany('App\Models\Asignatura','reticulas','plan_especialidad_id','asignatura_id')
            ->withPivot('periodo_reticula');
    }

    public function especialidad(){
        return $this->belongsTo('App\Models\Especialidad','especialidad_id');
    }
}
