<?php

namespace App\Http\Controllers\Admin\Caja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pagoEstudiante;
use App\Models\bancoModel;
use App\Models\conceptoModel;
use App\Models\Estudiante;
use App\Models\Especialidad;

class cajaController extends Controller
{
    function importar(){
    	return view('private.admin.caja.importar')
            ->with(['bancos' => bancoModel::all(),'conceptos' => conceptoModel::all()]);
    }

    function index(){
        return view('private.admin.caja.index',['estudiantes' => Estudiante::getEstudiantes(),'bancos' => bancoModel::all(),'conceptos' => conceptoModel::all()]);
    }

    function reportes(){
        return view('private.admin.caja.reportes',['especialidades' => Especialidad::getEspecialidades(),'bancos' => bancoModel::all()]);
    }

    function getEstudiantes(){
        $estudiantes = Estudiante::getEstudiantes();
        $dataNombre = array();
        foreach($estudiantes as $estudiante){
            $dataNombre[$estudiante -> matricula . ' - ' . $estudiante -> nombre] = null;
        }
        $response = new \stdClass;
        $response -> estudiantes = $estudiantes;
        $response -> dataNombre = $dataNombre;
        return response()->json($response);
    }


    function getPagosEstudiantes($page,$busqueda){
        $busqueda = explode(' - ', $busqueda);
        // dd($busqueda);
        $pagos = pagoEstudiante::getPagosEstudiantes($page,$busqueda);
        $pagos[0] -> totalRegistros = ((pagoEstudiante::getTotalPagosEstudiantes($busqueda) -> total) / 50 ) +1;
    	return $pagos;
    }

    function getPagosEstudiante($estudiante_id){
        return pagoEstudiante::getPagosEstudiante($estudiante_id);
    }

    function deletePagoEstudiante($pago_id){
        pagoEstudiante::deletePagoEstudiante($pago_id);
    }

    function setPagoEstudiante(Request $req){
        $matricula = explode('-', $req -> nombre)[0];
        $matricula = explode(' ', $matricula)[0];
        $matricula = Estudiante::getEstudianteID($matricula) -> id;
        // dd($matricula);
        $pago = pagoEstudiante::find($req -> id);
        if(!$pago)
            $pago = new pagoEstudiante;


        $pago -> recibo_folio = $req -> recibo_folio;
        $pago -> fecha_pago = $req -> fecha_pago;
        $pago -> cantidad = $req -> cantidad;
        $pago -> estudiante_id = $matricula;
        $pago -> concepto_id = $req -> concepto_id;
        $pago -> banco_id = $req -> banco_id;
        $pago -> hecho_por_id = \Session::get('usuario')->id;
        if(isset($req -> mes_inicio))
            $pago -> mes_inicio = $req -> mes_inicio;
        else
            $pago -> mes_inicio = 0;
        if(isset($req -> mes_final))
            $pago -> mes_final = $req -> mes_final;
        else
            $pago -> mes_final = 0;
        if(isset($req -> anio))
            $pago -> anio = $req -> anio;
        else
            $pago -> anio = 0;

        $pago -> save();

        if($req -> concepto_id == 2){
            $this -> promoverEstudiante($matricula);
        }

        return $pago;
    }

    function setPagosEstudiantes(Request $req){
        // dd($req -> pagos);
        foreach ($req -> pagos as $pagoActual) {
            $matricula = Estudiante::getEstudianteID($pagoActual['matricula']);
            if($matricula)
                $matricula = $matricula -> id;
            else
                $matricula = null;
            // dd($matricula);
           
                $pago = new pagoEstudiante;


            // $pago -> recibo_folio = $pagoActual['recibo_folio'];
            $pago -> fecha_pago = $pagoActual['fecha_pago'];
            $pago -> cantidad = $pagoActual['cantidad'];
            $pago -> estudiante_id = $matricula;
            $pago -> concepto_id = $pagoActual['concepto_id'];
            $pago -> banco_id = $pagoActual['banco_id'];
            $pago -> hecho_por_id = \Session::get('usuario')->id;
            if(isset($pagoActual['mes_inicio']))
                $pago -> mes_inicio = $pagoActual['mes_inicio'];
            else
                $pago -> mes_inicio = 0;
            if(isset($pagoActual['mes_final']))
                $pago -> mes_final = $pagoActual['mes_final'];
            else
                $pago -> mes_final = 0;
            if(isset($pagoActual['anio']))
                $pago -> anio = $pagoActual['anio'];
            else
                $pago -> anio = 0;

            $pago -> save();

            if($pagoActual['concepto_id'] == 2){
                $this -> promoverEstudiante($matricula);
            }
        }

        // return $pago;
    }

    function setArchivo(Request $req){
    	if ($req->hasFile('file')) {

			$file = $req -> file;
            $fileName = $file->getClientOriginalName();
			$file->storeAs('importers',$fileName);
            $content = file_get_contents('../storage/app/importers/' . $fileName);
            $lines = explode("\n", utf8_encode($content));
            if($file->getClientOriginalExtension() == 'csv')
                return $lines = $this -> normalizarSalidaCSV($lines);
            return $this -> normalizarSalidaTXT($lines,$fileName);
		}else{
			return 'Sin archivo';
		}
    }

    function normalizarSalidaCSV($lines){
        $continue = true;
        $line = 0;
        while($continue){
            if($line != 12)
                unset($lines[$line]);
            else{
                $continue = false;
                unset($lines[$line]);
            }
            $line++;
        }

        $response = [];
        $i = 0;

        $conceptos = conceptoModel::all();  
        foreach($lines as $line) { 
// "04/03/2019","Pago Interbancario Sucursal: 519 Referencia Númerica: 40319 Referencia Alfanúmerica: TRANSFERENCIA Autorización: 00031817","-","7,000.00"," "
            $data = explode("\",\"", $line);
            $icon = 'done';
            $message = '';
            if($data[3] == '-'){
                $matricula =  substr(explode("Referencia Númerica: ", $data[1])[1],0,5);
                $estudiante = Estudiante::getEstudianteXMatricula($matricula);
                $cantidad = (float)(str_replace(',','',$data[2]));
                $fecha_pago =  explode('/',explode("\"", $line)[1]);
                $fecha_pago = $fecha_pago[2] . '-' . $fecha_pago[1] . '-' . $fecha_pago[0];
                if(!$estudiante){
                    $nombre = 'No se ha encontrado una matricula válida';
                    $icon = 'warning';
                    $pagos = null;
                    $matricula = '00000';
                    $message .= ' ' . $nombre;
                    $estudiante_id = null;
                }else{
                    $nombre = $estudiante -> nombre;
                    $pagos = pagoEstudiante::getPagosEstudiante($estudiante -> id);
                    $estudiante_id = $estudiante -> id;
                }


                // dd($pagos);
                if($cantidad != 0){

                    $concepto = $this -> getPosibleConcepto($conceptos,$cantidad,$icon,$estudiante_id);
                    $message .= $concepto -> message;
                    $icon = $concepto -> icon;
                    if(isset($concepto->nextMes))
                        $mes_inicio = $concepto->nextMes;
                    else
                        $mes_inicio = null;

                    $response[$i] = new \stdClass;
                    $response[$i] -> original = $line;
                    $response[$i] -> matricula = $matricula;
                    $response[$i] -> nombre = $nombre;
                    $response[$i] -> factura = '';
                    $response[$i] -> concepto_id = 3;
                    $response[$i] -> cantidad = $cantidad;
                    $response[$i] -> fecha_pago = $fecha_pago;
                    $response[$i] -> banco_id = 8;
                    $response[$i] -> pagos = $pagos;
                    $response[$i] -> message = $message;
                    $response[$i] -> mes_inicio = $mes_inicio;
                    $response[$i] -> icon = $icon;
                    $i++;
                }
            }
        }

        return $response;
    }

    function normalizarSalidaTXT($lines,$fileName){
        $response = [];
        $i = 0;
        $fecha_pago = substr($fileName,23,4) . '-' . substr($fileName,27,2) . '-' . substr($fileName,29,2);
        $conceptos = conceptoModel::all();
        foreach($lines as $line) { 
            if($line != ''){
                $message = null;
                $icon = 'done';
                $banco_id = bancoModel::where('cuenta_bancaria',substr($line,0,11))->first();
                $cantidad = (float)substr($line,77,12);
                $tipo_linea = substr($line,40,9);
                if(!$banco_id)
                    $banco_id = null;
                else
                    $banco_id = $banco_id -> id;

                switch ($tipo_linea) {
                    case 'RANSF SPE': 
                        $matricula = (int)substr($line,153,7);
                    break;
                    case 'EN EFECTI':
                        $matricula = (int)substr($line,128,5);
                    break;
                    case 'EFECT ATM':
                        $matricula = (int)substr($line,113,5);
                    break;
                    case 'RANSF TEF':
                        $matricula = (int)substr($line,113,5);
                    break;
                    case 'RANS ELEC':
                        $matricula = (int)substr($line,113,5);
                        // dd($matricula);
                    break;
                }

                $estudiante = Estudiante::getEstudianteXMatricula($matricula);
                if(!$estudiante){
                    $nombre = 'No se ha encontrado una matricula válida';
                    $pagos = null;
                    $icon = 'warning';
                    $matricula = '00000';
                    $message .= ' ' . $nombre;
                    $estudiante_id = null;
                }else{
                    $nombre = $estudiante -> nombre;
                    $pagos = pagoEstudiante::getPagosEstudiante($estudiante -> id);
                    $estudiante_id = $estudiante -> id;
                }

                // dd($fecha_pago);

                $concepto = $this -> getPosibleConcepto($conceptos,$cantidad,$icon,$estudiante_id);
                $message .= $concepto -> message;
                $icon = $concepto -> icon;
                if(isset($concepto->nextMes)){
                    if($concepto->nextMes != null)
                        $mes_inicio = $concepto->nextMes;
                    else
                        $mes_inicio = date('m');
                }
                else
                    $mes_inicio = 1;
                // return response()->json($concepto);

                $response[$i] = new \stdClass;
                $response[$i] -> original = $line;
                $response[$i] -> matricula = $matricula;
                $response[$i] -> nombre = $nombre;
                $response[$i] -> factura = '';
                $response[$i] -> concepto_id = $concepto -> concepto_id;
                $response[$i] -> cantidad = $cantidad;
                $response[$i] -> fecha_pago = $fecha_pago;
                $response[$i] -> banco_id = $banco_id;
                $response[$i] -> pagos = $pagos;
                $response[$i] -> icon = $icon;
                $response[$i] -> mes_inicio = 'Jul';
                $response[$i] -> mes_final = 'Jul';
                $response[$i] -> anio = date('y');
                $response[$i] -> message = $message;
                $i++;
            }
        }

        return $response;
    }

    function getPosibleConcepto($conceptos,$cantidad,$icon,$estudiante_id){
        $listaConceptos = [];
        $response = new \stdClass;
        $response -> icon = $icon;
        $response -> concepto_id = 29;
        $response -> message = null;

        if($cantidad >= 750){
            $inscrpcion = pagoEstudiante::getReinscripcion($estudiante_id,1);
            if($inscrpcion){
                $mensualidad = pagoEstudiante::geMensualidades($estudiante_id,1);
                // dd($mensualidad);
                if($mensualidad->status){
                   $listaConceptos[] = $conceptos[2];
                   $response -> mes_final = $response -> mes_inicio = $mensualidad -> nextMes;
                }else{
                    $listaConceptos[] = $conceptos[1];
                    $response -> mes_final = 'Ene';
                    $response -> mes_inicio = 'Jun';
                }
            }else{
                $inscrpcion = pagoEstudiante::getReinscripcion($estudiante_id,2);
                if($inscrpcion){
                    $mensualidad = pagoEstudiante::geMensualidades($estudiante_id,2);
                // dd($mensualidad);
                    if($mensualidad->status){
                       $listaConceptos[] = $conceptos[2];
                       $response -> mes_final = $response -> mes_inicio = $mensualidad -> nextMes;
                    }else{
                        $listaConceptos[] = $conceptos[1];
                        $response -> mes_final = 'Jul';
                        $response -> mes_inicio = 'DIC';
                    }
                }

            }
        }
        foreach ($conceptos as $concepto) {
            if($concepto -> costo == $cantidad){
                // dd($cantidad);
                $listaConceptos[] = $concepto;
            }
        }

        if(sizeof($listaConceptos) == 0){
            $response -> icon = 'warning';
            $response -> message = 'No hay ninguna considencia de conceptos de pago.';
        }else{
            if(sizeof($listaConceptos) > 1){
                $response -> icon = 'warning';
                $response -> message = 'Hay más de una posible considencia de conceptosde pago.';
            }
            $response -> concepto_id = $listaConceptos[0] -> id;
        }
        $response -> listaConceptos = $listaConceptos;
        return $response;
    }

    function promoverEstudiante($estudiante_id){
        $estudiante = Estudiante::find($estudiante_id);
        // dd($estudiante);
        if($estudiante){
            $semestre = (int)($estudiante -> semestre);
            // dd($semestre);
            $estudiante -> semestre = $semestre + 1;
            $estudiante -> save();
        }
    }
}
