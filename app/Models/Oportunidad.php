<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oportunidad extends Model
{
    protected $table = 'oportunidades';
    
    protected $fillable = [
    	'oportunidad','descripcion'
    ];

    public $timestamps = false;

    public function grupos(){
    	return $this->hasMany('App\Models\Grupo','oportunidad_id');
    }

    public function kardexs(){
    	return $this->hasMany('App\Models\Kardex','oportunidad_id');
    }
}
