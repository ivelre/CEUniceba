<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPlanEspecialidad extends Model
{
    protected $table = 'tipos_planes_especialidades';
    
    protected $fillable = [
    	'tipo_plan_especialidad','descripcion'
    ];

    public $timestamps = false;

    public function especialidades(){
    	return $this->hasMany('App\Models\Especialidad','tipo_plan_especialidad_id');
    }
}
