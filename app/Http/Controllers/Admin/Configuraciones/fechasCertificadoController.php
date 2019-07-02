<?php

namespace App\Http\Controllers\Admin\Configuraciones;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FechaCertificado;

class fechasCertificadoController extends Controller
{
    public function index(){
        $fechas = FechaCertificado::all();
        foreach ($fechas as $key => $fecha)
            $fechas[$key] -> fecha = $this -> obtenerFechaEnLetra($fecha -> fecha_certificado);
    	return view('private.admin.configuraciones.fechas_certificado.index',
    							['fechas' => $fechas]);
    }

    public function store(Request $req){
    	$fecha_certificado = FechaCertificado::find($req -> id);
    	if(!$fecha_certificado)
    		$fecha_certificado = new FechaCertificado;

    	$fecha_certificado -> fecha_certificado = $req -> fecha_certificado;
    	$fecha_certificado -> save();
    }

    public function destroy(Request $req){
    	FechaCertificado::find($req -> id)->delete();
    }

    function obtenerFechaEnLetra($fecha){
        $num = date("j", strtotime($fecha));
        $ano = date("Y", strtotime($fecha));
        $mes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        $mes = $mes[(date('m', strtotime($fecha))*1)-1];
        return $num.' DE '.$mes.' DE '.$ano;
    }
}
