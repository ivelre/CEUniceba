<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Titulacion extends Model
{
    protected $table = 'titulaciones';
    
    protected $fillable = [
    	'tipo_id','estudiante_id','fecha_inicio','observaciones','estado_id'
    ];

    public $timestamps = false;

    public function documentos_titulaciones(){
    	return $this->hasMany('App\Models\DocumentoTitulacion','titulo_id');
    }

    public function tipo_titulacion(){
    	return $this->belongsTo('App\Models\TipoTitulacion','tipo_id');
    }

    public function estudiante(){
    	return $this->belongsTo('App\Models\Estudiante','estudiante_id');
    }

    public function estado_titulacion(){
    	return $this->belongsTo('App\Models\EstadoTitulacion','estado_ids');
    }
}
