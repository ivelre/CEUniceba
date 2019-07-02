<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    
    protected $fillable = [
    	'empresa','direccion'
    ];

    public $timestamps = false;

    public function estudiantes(){
    	return $this->belongsToMany('App\Models\Estudiante','estudiantes_trabajos','empresa_id','estudiante_id')
    		->withPivot('puesto');
    }
}
