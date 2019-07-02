<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    protected $table = 'titulos';
    
    protected $fillable = [
    	'titulo','descripcion'
    ];

    public $timestamps = false;

    public function docentes(){
    	return $this->hasMany('App\Models\Docente','titulo_id');
    }
}
