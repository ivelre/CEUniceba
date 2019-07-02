<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';
    
    protected $fillable = [
    	'clase_id','estudiante_id','oportunidad_id'
    ];

    public $timestamps = false;

    public function clase(){
    	return $this->belongsTo('App\Models\Clase','clase_id');
    }

    public function estudiante(){
    	return $this->belongsTo('App\Models\Estudiante','estudiante_id');
    }

    public function oportunidad(){
    	return $this->belongsTo('App\Models\Oportunidad','oportunidad_id');
    }

    static function getAlumosGrupo($clase_id,$oportunidad_id = null){
        $response = \DB::table('grupos')
            ->select('estudiantes.matricula','calificacion','grupos.estudiante_id', \DB::raw("CONCAT(apaterno , ' ' , amaterno , ' ' , nombre ) AS nombre"),'grupos.oportunidad_id', 'oportunidad','estudiantes.semestre', 'kardexs.id as kardex_id','grupos.id as grupo_id','temp_adeudos.matricula as adeudo')
            ->join('oportunidades','oportunidades.id','grupos.oportunidad_id')
            ->join('estudiantes','estudiantes.id','grupos.estudiante_id')
            ->leftjoin('temp_adeudos','temp_adeudos.matricula','estudiantes.matricula')
            ->join('datos_generales','datos_generales.id','estudiantes.dato_general_id')
            ->leftjoin('kardexs','kardexs.grupo_id','grupos.id')
            ->where('grupos.clase_id', $clase_id)
            ->orderby('nombre','asc');
        if($oportunidad_id != null)
            $response->where('grupos.oportunidad_id', $oportunidad_id);
        return $response->get();
    }
}
