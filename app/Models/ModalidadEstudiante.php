<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadEstudiante extends Model
{
    protected $table = 'modalidades_estudiantes';
    
    protected $fillable = [
    	'modalidad_estudiante','descripcion'
    ];

    public $timestamps = false;

    public function estudiantes(){
    	return $this->hasMany('App\Models\Estudiante','modalidad_id');
    }
}
