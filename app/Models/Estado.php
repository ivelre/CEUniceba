<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    
    protected $fillable = [
    	'pais_id','clave','estado','abreviatura','activo'
    ];

    public $timestamps = false;

    public function municipios(){
    	return $this->hasMany('App\Models\Municipio','estado_id');
    }

    public function pais(){
    	return $this->belongsTo('App\Models\Pais','pais_id');
    }
}
