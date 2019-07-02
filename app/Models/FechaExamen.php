<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FechaExamen extends Model
{
    protected $table = 'fechas_examenes';
    
    protected $fillable = [
    	'tipos_examen_id','fecha_inicio','fecha_final','periodo_id','descripcion'
    ];

    public $timestamps = false;

    public function tipo_examen(){
    	return $this->belongsTo('App\Models\TipoExamen','tipos_examen_id');
    }

    public function periodo(){
    	return $this->belongsTo('App\Models\Periodo','periodo_id');
    }
}
