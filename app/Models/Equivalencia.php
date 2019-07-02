<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equivalencia extends Model
{
    protected $table = 'equivalencias';
    
    protected $fillable = [
    	'estudiante_id','folio','fecha'
    ];

    public $timestamps = false;

    public function estudiante(){
    	return $this->belongsTo('App\Models\Estudiante','estudiante_id');
    }
}
