<?php

namespace App\Http\Controllers\Admin\Academicos;

use App\Models\Kardex;
use App\Models\Grupo;
use App\Models\Estudiante;
use App\Models\Reticula;
use App\Models\Periodo;
use App\Models\Oportunidad;
use App\Models\FechaCertificado;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Kardex\IndexRequest;

class reportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.academicos.reportes.index');
    }

    public function boletas($oportunidad_id)
    {
        return view('private.admin.academicos.reportes.boletas',['periodos' => Periodo::all(),'oportunidad_id' => $oportunidad_id]);
    }

    public function getEstudiantes($periodo_id,$oportunidad_id)
    {
        return Kardex::getEstudiantesXPeriodo($periodo_id,$oportunidad_id);
    }

    function obtenerFechaEnLetra($fecha){
        $num = date("j", strtotime($fecha));
        $ano = date("Y", strtotime($fecha));
        $mes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        $mes = $mes[(date('m', strtotime($fecha))*1)-1];
        return $num.' DE '.$mes.' DE '.$ano;
    }
}
