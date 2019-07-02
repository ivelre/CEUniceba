<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelAcademico extends Model
{
    protected $table = 'niveles_academicos';
    
    protected $fillable = [
    	'nivel_academico','descripcion'
    ];

    public $timestamps = false;

    public function especialidades(){
    	return $this->hasMany('App\Models\Especialidad','nivel_academico_id');
    }
}
