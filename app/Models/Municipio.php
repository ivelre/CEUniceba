<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';
    
    protected $fillable = [
    	'estado_id','clave','municipio','activo'
    ];

    public $timestamps = false;

    public function localidades(){
    	return $this->hasMany('App\Models\Localidad','municipio_id');
    }

    public function institutos_procedencias(){
    	return $this->hasMany('App\Models\InstitutoProcedencia','municipio_id');	
    }

    public function estado(){
    	return $this->belongsTo('App\Models\Estado','estado_id');
    }
}
