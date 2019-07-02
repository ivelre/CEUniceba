<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPlan extends Model
{
    protected $table = 'tipos_planes';
    
    protected $fillable = [
    	'tipo_plan','descripcion'
    ];

    public $timestamps = false;

    public function especialidades(){
    	return $this->hasMany('App\Models\Especialidad','tipo_plan_id');
    }
}
