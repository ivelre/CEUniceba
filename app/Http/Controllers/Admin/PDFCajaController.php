<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\pagoEstudiante;
use App\Models\bancoModel;

date_default_timezone_set('America/Mexico_City');

class PDFCajaController extends Controller
{
		/**
     * Descarga de pdf para certificado parcial.
     *
     * @author Jacobo Gonzalez Tamayo <girisnotadog@gmail.com>
     * @return pdf
     */
		public function ingresos($tipo_reporte,$especialidad,$fecha_inicio,$fecha_final) {
			$pagos = pagoEstudiante::getPagosReporte($tipo_reporte,$especialidad,$fecha_inicio,$fecha_final);

			// dd($pagos);
      $pdf = new Fpdf('P','mm','Legal');
      
      $pdf->AddPage();
      
      $pdf->SetFont('Times','B',12);
    	$pdf->setXY(15,10);
    	$pdf->Cell(15,5, utf8_decode('UNIVERSIDAD DEL CENTRO DEL BAJÍO'), 0, 1, 'L');
    	$pdf->setXY(15,15);
    	$pdf->Cell(15,5, utf8_decode('REPORTE DE INGRESOS POR DÍA.'), 0, 1, 'L');
    	$pdf->setXY(15,20);
    	$pdf->Cell(15,5, utf8_decode('DEL ' . $this->obtenerFechaEnLetra($fecha_inicio) . ' AL ' . $this->obtenerFechaEnLetra($fecha_final) . '.'), 0, 1, 'L');

    	$pdf->SetFont('Times','B',9);
    	$pdf->setXY(15,30);
    	$pdf->Cell(15,5, utf8_decode('Matricula'), 1, 1, 'C');

    	$pdf->setXY(30,30);
    	$pdf->Cell(80,5, utf8_decode('Nombre'), 1, 1, 'C');

    	$pdf->setXY(110,30);
    	$pdf->Cell(15,5, utf8_decode('Fecha'), 1, 1, 'C');

    	$pdf->setXY(125,30);
    	$pdf->Cell(15,5, utf8_decode('factura'), 1, 1, 'C');

    	$pdf->setXY(140,30);
    	$pdf->Cell(25,5, utf8_decode('Concepto'), 1, 1, 'C');

    	$pdf->setXY(165,30);
    	$pdf->Cell(15,5, utf8_decode('Importe'), 1, 1, 'C');

    	$pdf->setXY(180,30);
    	$pdf->Cell(20,5, utf8_decode('Especialidad'), 1, 1, 'C');

    	$y = $pdf->getY();
    	$total = 0;
    	$pdf->SetFont('Times','',7.5);
      $contador = 1;
    	foreach ($pagos as $pago) {
    		$pdf->setXY(15,$y);
	    	$pdf->Cell(15,5, utf8_decode( $pago -> matricula ), 1, 1, 'C');

	    	$pdf->setXY(30,$y);
	    	$pdf->Cell(80,5, utf8_decode( $pago -> nombre ), 1, 1, 'L');

	    	$pdf->setXY(110,$y);
	    	$pdf->Cell(15,5, utf8_decode( $pago -> fecha_pago ), 1, 1, 'C');

	    	$pdf->setXY(125,$y);
	    	$pdf->Cell(15,5, utf8_decode( $pago -> recibo_folio ), 1, 1, 'C');

	    	$pdf->setXY(140,$y);
	    	$pdf->Cell(25,5, utf8_decode( $pago -> concepto ), 1, 1, 'C');

	    	$pdf->setXY(165,$y);
	    	$pdf->Cell(15,5, utf8_decode( $pago -> cantidad . '.00'), 1, 1, 'C');

	    	$pdf->setXY(180,$y);
	    	$pdf->Cell(20,5, utf8_decode( $pago -> clave ), 1, 1, 'C');

	    	$total += (float) $pago -> cantidad;

        $contador++;
        if($contador == 58){
          $pdf->AddPage();
          $y = 15;
          $contador = 1;
        }

	    	$y+=5;
    	}

    	$pdf->SetFont('Times','B',7.5);
    	$pdf->setXY(140,$y);
    	$pdf->Cell(25,5, utf8_decode('Total' ), 1, 1, 'C');

    	$pdf->setXY(165,$y);
    	$pdf->Cell(15,5, utf8_decode($total . '.00'), 1, 1, 'C');

    	

      $pdf->setTitle('Reporte del día ' . $fecha_inicio, true);
      $pdf->Output('I', 'reporte del día ' . $fecha_inicio, true);

      exit; // Indispensable para que funcione el PDF
    }

    function poliza($banco_id,$fecha_inicio,$fecha_final){
    	$total = pagoEstudiante::getTotalPolizaBanco($banco_id,$fecha_inicio,$fecha_final) -> total;
    	$banco = bancoModel::find($banco_id);
    	$conceptos = pagoEstudiante::getPagosPolizaBanco($banco_id,$fecha_inicio,$fecha_final);
      $strJsonFileContents = file_get_contents("../storage/app/totalPolizas.json");
      $array = json_decode($strJsonFileContents, true);
    	$numero = $array['polizas'];
    	$poliza = 'P  ' . str_replace('-','',$fecha_inicio) . '    1      ' . $numero . ' 1 0          INGRESOS ' . $banco -> descripcion;
    	$poliza = $this -> addSpaces($poliza,141);
    	$poliza .= "11 0 0                                                                                                       \n";
      $line = 'M  ' .  str_replace('-','',$banco -> cuenta_contabilidad) . '                             0 ' . $total . '.0';
      $poliza .= $this -> addSpaces($line,68);
      $poliza .= "0          0.0                                                                                                                                                                        \n";
    	if($conceptos){
	    	foreach ($conceptos as $concepto) { 
		    	$line = 'M  ' .  str_replace('-','',$concepto -> cuenta) . '                             1 ' . $concepto -> cantidad . '.0';
		    	$poliza .= $this -> addSpaces($line,68);
		    	$poliza .= "0          0.0                                                                                                                                                                        \n";
	    	}
	    }

    	$this -> savePoliza($poliza);

      $array['polizas'] ++;

      $fp = fopen('../storage/app/totalPolizas.json', 'w');
      fwrite($fp, json_encode($array));
      fclose($fp);

    	return response()->download('../storage/app/polizas/Poliza-030619-030619EFE.TXT');
    }

    function obtenerFechaEnLetra($fecha){
	    $num = date("j", strtotime($fecha));
	    $ano = date("Y", strtotime($fecha));
	    $mes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
	    $mes = $mes[(date('m', strtotime($fecha))*1)-1];
	    return $num.' DE '.$mes.' DE '.$ano;
		}

		function getNumeroLetra($numero){
      switch ($numero) {
        case 1:return 'UNO'; break;
        case 2:return 'DOS'; break;
        case 3:return 'TERS'; break;
        case 4:return 'CUATRO'; break;
        case 5:return 'CINCO'; break;
        case 6:return 'SEIS'; break;
        case 7:return 'SIETE'; break;
        case 8:return 'OCHO'; break;
        case 9:return 'NUEVE'; break;
        case 10:return 'DIEZ'; break;
       default :return '--'; break;
      }
    }

		function searchDocument($documentos,$documento_id){
      foreach ($documentos as $documento) {
      	if($documento -> tipo_documento_id == $documento_id)
      		return 'X';
      }
      return '';
    }

    function savePoliza($poliza){
      $totalArchivos = 0;
    	$myfile = fopen("../storage/app/polizas/Poliza-030619-030619EFE.TXT", "w") or die("Unable to open file!");
			fwrite($myfile, $poliza);
			fclose($myfile);
    }

    function addSpaces($linea,$total){
    	for($i = strlen($linea); $i < $total; $i++)
    		$linea .= ' ';
    	return $linea;
    }
}
