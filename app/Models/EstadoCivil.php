<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $table = 'estados_civiles';
    
    protected $fillable = ['estado_civil'];

    public $timestamps = false;

    public function datos_generales(){
    	return $this->hasMany('App\Models\DatoGeneral','estado_civil_id');
    }
}
