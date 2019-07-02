<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoTitulacion extends Model
{
    protected $table = 'estados_titulaciones';
    
    protected $fillable = ['estado_titulacion','descripcion'];

    public $timestamps = false;

    public function estudiantes(){
    	return $this->hasMany('App\Models\Titulacion','estado_id');
    }
}
