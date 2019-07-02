<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    protected $table = 'nacionalidades';
    
    protected $fillable = ['nacionalidad'];

    public $timestamps = false;

    public function datos_generales(){
    	return $table->hasMany('App\Models\DatoGeneral','nacionalidad_id');
    }

}
