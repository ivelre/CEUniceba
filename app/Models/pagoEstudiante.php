<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pagoEstudiante extends Model
{
    protected $table = 'pagos_estudiante';
    
    protected $fillable = [
    	'estudiante_id', 'recibo_folio', 'fecha_pago', 'concepto_id', 'cantidad', 'mes_inicio', 'mes_final', 'anio', 'hecho_por_id', 'catalogo_contabilidad_id', 'banco_id'
    ];

    public $timestamps = false;

    static function getPagosEstudiantes($page,$busqueda){
        $response = \DB::table('pagos_estudiante')
                    ->select('matricula',\DB::raw("CONCAT(apaterno , ' ' , amaterno , ' ' , nombre ) AS nombre"),'recibo_folio','concepto_id','concepto','cantidad','pagos_estudiante.fecha_pago','estado_estudiante',\DB::raw("CONCAT(nivel_academico , ' en ' , especialidad) AS especialidad"),\DB::raw("CONCAT(mes_inicio , '-' , mes_final, '-',anio) AS cubre"),'cuenta_bancaria','mes_inicio','mes_final','anio','banco_id','pagos_estudiante.id as id')
                    ->leftjoin('estudiantes','estudiantes.id','pagos_estudiante.estudiante_id')
                    ->leftjoin('bancos','bancos.id','pagos_estudiante.banco_id')
                    ->leftjoin('datos_generales','datos_generales.id','estudiantes.dato_general_id')
                    ->leftjoin('conceptos','conceptos.id','pagos_estudiante.concepto_id')
                    ->leftjoin('estados_estudiantes','estados_estudiantes.id','estudiantes.estado_estudiante_id')
                    ->leftjoin('especialidades','especialidades.id','estudiantes.especialidad_id')
                    ->leftjoin('niveles_academicos','niveles_academicos.id','especialidades.nivel_academico_id')
                    ->orderby('pagos_estudiante.id','desc');
        if($busqueda[0] != '-'){
            $response -> where('matricula','like',"%$busqueda[0]%");
        }
        $response -> limit(50)
                  -> offset(50 * ($page - 1));
        $totalRegistros = \DB::table('pagos_estudiante')->count();
        // $response -> totalRegistros = $totalRegistros;
        // dd($response);
        return $response->get();
    }

    static function getTotalPagosEstudiantes($busqueda){
        $response = \DB::table('pagos_estudiante')
                    ->select(\DB::raw("COUNT(*) AS total"));
        if($busqueda[0] != '-'){
            $response -> where('matricula','like',"%$busqueda[0]%")
                    ->join('estudiantes','estudiantes.id','pagos_estudiante.estudiante_id');
        }
        // dd($response->get());
        return $response->first();
    }

    static function getPagosEstudiante($estudiante_id){
        return \DB::table('pagos_estudiante')
                    ->join('conceptos','conceptos.id','pagos_estudiante.concepto_id')
                    ->where('estudiante_id',$estudiante_id)
                    ->limit(3)
                    ->orderby('pagos_estudiante.id','desc')
                    ->get();
    }

    static function getReinscripcion($estudiante_id,$tipo){
        $anio = date('y');
        $month = date('m');
        if($month < 7){
            if($tipo == 1){
                $anio--;
                $mes_inicio = 'Jul';
                $mes_final = 'Dic';
            }else{
                $mes_inicio = 'Ene';
                $mes_final = 'Jun';
            }
        }
        else{
            if($tipo == 1){
                $mes_inicio = 'Ene';
                $mes_final = 'Jun';
            }else{
                $mes_inicio = 'Jul';
                $mes_final = 'Dic';
            }
        }

        return \DB::table('pagos_estudiante')
                    ->join('conceptos','conceptos.id','pagos_estudiante.concepto_id')
                    ->where('estudiante_id',$estudiante_id)
                    ->where('mes_inicio',$mes_inicio)
                    ->where('mes_final',$mes_final)
                    ->where('anio',$anio)
                    ->first();
    }

    static function geMensualidades($estudiante_id,$tipo){
        $anio = date('y');
        $month = date('m');
        if($month < 7){
           if($tipo == 1){
                $anio--;
                $mes_inicio = ['Jul','Ago','Sep','Oct','Nov','Dic'];
            }else{
                $mes_inicio = ['Ene','Feb','Mar','Abr','May','Jun'];
            }
        }
        else{
            if($tipo == 1){
                $mes_inicio = ['Ene','Feb','Mar','Abr','May','Jun'];
            }else{
                $mes_inicio = ['Jul','Ago','Sep','Oct','Nov','Dic'];
            }
        }

        // dd($mes_inicio);

        $response = new \stdClass;
        $response->status = false;

        $mensualidad = \DB::table('pagos_estudiante')
                    ->join('conceptos','conceptos.id','pagos_estudiante.concepto_id')
                    ->where('estudiante_id',$estudiante_id)
                    ->where(function($query) use ($mes_inicio){
                                $query->where('mes_inicio',$mes_inicio[0]);
                                $query->orWhere('mes_inicio',$mes_inicio[1]);
                                $query->orWhere('mes_inicio',$mes_inicio[2]);
                                $query->orWhere('mes_inicio',$mes_inicio[3]);
                                $query->orWhere('mes_inicio',$mes_inicio[4]);
                                $query->orWhere('mes_inicio',$mes_inicio[5]);
                            })
                    ->where('anio',$anio)
                    ->orderby('pagos_estudiante.id','desc')
                    ->first();
        if($mensualidad){
            $response->status = true;
            switch ($mensualidad -> mes_final) {
                case 'Ene': $response->nextMes = 'Feb'; break;
                case 'Feb': $response->nextMes = 'Mar'; break;
                case 'Mar': $response->nextMes = 'Abr'; break;
                case 'Abr': $response->nextMes = 'May'; break;
                case 'May': $response->nextMes = 'Jun'; break;
                case 'Jun': $response->nextMes = 'Jul'; break;
                case 'Jul': $response->nextMes = 'Ago'; break;
                case 'Ago': $response->nextMes = 'Sep'; break;
                case 'Sep': $response->nextMes = 'Oct'; break;
                case 'Oct': $response->nextMes = 'Nov'; break;
                case 'Nov': $response->nextMes = 'Dic'; break;
                case 'Dic': $response->nextMes = 'Ene'; break;
            }
        }
        return $response;
    }

    static function getPagosReporte($tipo_reporte,$especialidad,$fecha_inicio,$fecha_final){
        $response = \DB::table('pagos_estudiante')
                    ->select('matricula','especialidades.clave',\DB::raw("CONCAT(apaterno , ' ' , amaterno , ' ' , nombre ) AS nombre"),'recibo_folio','concepto_id','concepto','cantidad','pagos_estudiante.fecha_pago','estado_estudiante',\DB::raw("CONCAT(nivel_academico , ' en ' , especialidad) AS especialidad"),\DB::raw("CONCAT(mes_inicio , '-' , mes_final, '-',anio) AS cubre"),'cuenta_bancaria')
                    ->leftjoin('estudiantes','estudiantes.id','pagos_estudiante.estudiante_id')
                    ->leftjoin('bancos','bancos.id','pagos_estudiante.banco_id')
                    ->leftjoin('datos_generales','datos_generales.id','estudiantes.dato_general_id')
                    ->leftjoin('conceptos','conceptos.id','pagos_estudiante.concepto_id')
                    ->leftjoin('estados_estudiantes','estados_estudiantes.id','estudiantes.estado_estudiante_id')
                    ->leftjoin('especialidades','especialidades.id','estudiantes.especialidad_id')
                    ->leftjoin('niveles_academicos','niveles_academicos.id','especialidades.nivel_academico_id');
        switch ($tipo_reporte) {
            case 1:$response -> where('especialidades.nivel_academico_id',$tipo_reporte); break;
            case 2:$response -> where('especialidades.nivel_academico_id',$tipo_reporte); break;
            case 3:$response -> where('especialidades.nivel_academico_id',$tipo_reporte); break;
            case 4:$response -> where('estudiantes.especialidad_id',$especialidad); break;
        }
        $response -> whereBetween('fecha_pago', [$fecha_inicio, $fecha_final]);
        return $response->get();
    }

    static function getTotalPolizaBanco($banco_id,$fecha_inicio,$fecha_final){
        return \DB::table('pagos_estudiante')
                ->select(\DB::raw('SUM(cantidad) as total'))
                ->leftjoin('bancos','bancos.id','pagos_estudiante.banco_id')
                ->where('banco_id',$banco_id)
                ->whereBetween('fecha_pago', [$fecha_inicio, $fecha_final])
                ->first();
         
    }

    static function getPagosPolizaBanco($banco_id,$fecha_inicio,$fecha_final){
        return \DB::table('pagos_estudiante')
                ->leftjoin('catalogos_contabilidad','catalogos_contabilidad.id','pagos_estudiante.catalogo_contabilidad_id')
                ->where('banco_id',$banco_id)
                ->whereBetween('fecha_pago', [$fecha_inicio, $fecha_final])
                ->get();
         
    }

    static function deletePagoEstudiante($id){
        return \DB::table('pagos_estudiante')->where('id',$id)->delete();
         
    }

}
