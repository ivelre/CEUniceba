<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedioEnterado extends Model
{
    protected $table = 'medios_enterados';
    
    protected $fillable = [
    	'medio_enterado','descripcion'
    ];

    public $timestamps = false;

    public function estudiantes(){
    	return $this->hasMany('App\Models\Estudiante','medio_enterado_id');
    }
}
