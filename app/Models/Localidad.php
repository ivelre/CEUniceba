<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';
    
    protected $fillable = [
    	'municipio_id','clave','localidad','latitud','longitud','lat','lng','altitud','activo'
    ];

    public $timestamps = false;

    public function datos_generales(){
    	return $this->hasMany('App\Models\DatoGeneral','localidad_id');
    }

    public function municipio(){
    	return $this->belongsTo('App\Models\Municipio','municipio_id');
    }
}
