<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class estudianteModel extends Model
{
    protected $table = 'estudiantes';
    public $timestamps = false;

    static  function getEstudiantes(){
    	return \DB::table('estudiantes')
    				->select('estudiantes.id',\DB::raw("CONCAT(apaterno , ' ' , amaterno , ' ' , nombre ) AS nombre"),'matricula')
            ->join('datos_generales','datos_generales.id','estudiantes.dato_general_id')
    				->get();
    }

    static  function getEstudianteID($matricula){
    	return \DB::table('estudiantes')
            ->where('matricula',$matricula)
    				->first();
    }
}
