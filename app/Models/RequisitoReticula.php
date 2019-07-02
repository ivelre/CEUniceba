<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequisitoReticula extends Model
{
    protected $table = 'requisitos_reticulas';
    
    protected $fillable = [
    	'reticula_id','reticula_requisito_id'
    ];

    public $timestamps = false;

    public function reticula(){
    	return $this->belongsTo('App\Models\Asignatura','reticula_id');
    }

    public function reticulas(){
    	return $this->hasMany('App\Models\Asignatura','reticula_requisito_id');
    }
}
