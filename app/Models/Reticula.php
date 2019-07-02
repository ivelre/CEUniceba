<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reticula extends Model
{
    protected $table = 'reticulas';
    
    protected $fillable = [
    	'plan_especialidad_id','asignatura_id','periodo_reticula'
    ];

    public $timestamps = false;

    public function asignatura(){
    	return $this->belongsTo('App\Models\Asignatura','asignatura_id');
    }

    public function plan_especialidad(){
        return $this->belongsTo('App\Models\PlanEspecialidad','plan_especialidad_id');
    }

    public function requisitos(){
        return $this->belongsToMany('App\Models\Reticula','requisitos_reticulas','reticula_id','reticula_requisito_id');
    }

    public function requisito(){
        return $this->belongsToMany('App\Models\Reticula','requisitos_reticulas','reticula_requisito_id','reticula_id');
    }
}
