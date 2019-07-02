<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoExamen extends Model
{
    protected $table = 'tipos_examenes';
    
    protected $fillable = [
    	'tipo_examen','descripcion'
    ];

    public $timestamps = false;

    public function fechas_exameens(){
    	return $this->hasMany('App\Models\FechaExamen','tipo_examen_id');
    }
}
