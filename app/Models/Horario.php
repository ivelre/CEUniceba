<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';
    
    protected $fillable = [
    	'dia_id','clase_id','hora_entrada','hora_salida'
    ];

    public $timestamps = false;

    public function dia(){
    	return $this->belongsTo('App\Models\Dia','dia_id');
    }

    public function clase(){
    	return $this->belongsTo('App\Models\Clase','clase_id');
    }
}
