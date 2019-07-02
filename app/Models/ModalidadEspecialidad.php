<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadEspecialidad extends Model
{
    protected $table = 'modalidades_especialidades';
    
    protected $fillable = [
    	'modalidad_especialidad','descripcion'
    ];

    public $timestamps = false;

    public function especialidades(){
    	return $this->hasMany('App\Models\Especialidad','modalidad_id');
    }
}
