<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'paises';
    
    protected $fillable = [
    	'clave','pais'
    ];

    public $timestamps = false;

    public function estados(){
    	return $this->hasMany('App\Models\Estado','pais_id');
    }
}
