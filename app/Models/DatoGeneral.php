<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatoGeneral extends Model
{
    protected $table = 'datos_generales';
    
    protected $fillable = [
    	'curp','nombre','apaterno','amaterno','fecha_nacimiento','calle_numero','colonia','codigo_postal','localidad_id','telefono_personal','telefono_casa','estado_civil_id','sexo','fecha_registro','nacionalidad_id','email','foto'
    ];

    public $timestamps = false;

    // Mutadores
    public function getNombreAttribute($value) {
        return trim($value);
    }

    public function getApaternoAttribute($value) {
        return trim($value);
    }

    public function getAmaternoAttribute($value) {
        return trim($value);
    }

    public function docentes(){
    	return $this->hasMany('App\Models\Docente','dato_general_id');
    }

    public function estudiantes(){
    	return $this->hasMany('App\Models\Estudiante','dato_general_id');
    }

    public function localidad(){
    	return $this->belongsTo('App\Models\Localidad','localidad_id');
    }

    public function estado_civil(){
    	return $this->belongsTo('App\Models\EstadoCivil','estado_civil_id');
    }

    public function nacionalidad(){
    	return $this->belongsTo('App\Models\Nacionalidad','nacionalidad_id');
    }
}
