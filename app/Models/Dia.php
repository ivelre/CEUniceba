<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    protected $table = 'dias';
    
    protected $fillable = ['dia'];

    public $timestamps = false;

    public function horarios(){
    	return $this->hasMany('App\Models\Horario','dia_id');
    }
}
