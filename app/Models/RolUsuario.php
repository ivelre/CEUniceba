<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    protected $table = 'roles_usuarios';
    
    protected $fillable = [
    	'rol_usuario','descripcion'
    ];

    public $timestamps = false;

    public function usuarios(){
    	return $this->hasMany('App\Models\Usuario','rol_id');
    }
}
