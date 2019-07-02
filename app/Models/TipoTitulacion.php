<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTitulacion extends Model
{
    protected $table = 'tipos_titulaciones';
    
    protected $fillable = [
    	'tipo_titulacion','descripcion'
    ];

    public $timestamps = false;

    public function titulaciones(){
    	return $this->hasMany('App\Models\Titulaciones','tipo_id');
    }
}
