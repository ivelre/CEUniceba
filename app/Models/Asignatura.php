<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'asignaturas';

    protected $fillable = [
    	'codigo','asignatura','creditos'
    ];

    public $timestamps = false;

    public function planes_especialidades(){
        return $this->belongsToMany('App\Models\PlanEspecialidad','reticulas','asignatura_id','plan_especialidad_id')
            ->withPivot('periodo_reticula');
    }

    public function reticulas(){
        return $this->hasMany('App\Models\Reticula','asignatura_id');
    }

    public function clases(){
        return $this->hasMany('App\Models\Clase','asignatura_id');
    }

    public function kardexs(){
        return $this->hasMany('App\Models\Kardex','asignatura_id');
    }
}
