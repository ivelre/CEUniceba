<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Kardex;
use App\Models\Estudiante;
use App\Models\Periodo;
use App\Models\Clase;
use App\Models\Grupo;

date_default_timezone_set('America/Mexico_City');

class PDFListaGrupoController extends Controller
{
		/**
     * Descarga de pdf para certificado parcial.
     *
     * @author Jacobo Gonzalez Tamayo <girisnotadog@gmail.com>
     * @return pdf
     */
		public function lista() {
      // PREPARACIÓN DE INFORMACIÓN
      //dd($clase);
      // GENERACIÓN DEL DOCUMENTO
      $pdf = new Fpdf('P','mm','Letter');
      // dd(\Session::get('grupos_print'));
      foreach (\Session::get('grupos_print') as $grupo) {
        if($grupo['print']){
          $clase = Clase::getDatosClase($grupo['clase_id']);
          $grupo = Grupo::getAlumosGrupo($grupo['clase_id'],null);

          $pdf = $this->getListas($pdf,$clase,$grupo);
        }
      }


      $pdf->setTitle('Lista de asistencia ', true);
      $pdf->Output('I', 'Lista de asistencia ', true);

      exit; // Indispensable para que funcione el PDF
    }

    public function getListas($pdf,$clase,$grupo) {
    	// dd($clase);
			$pdf->AddPage();
      // $pdf->Image(public_path() . '/images/pdf base/3.jpg',0,0,216,277);
      $pdf->SetLineWidth(0.1);

    	$pdf->setXY(53,20);
    	$pdf->SetFont('Times','B',12);
    	$pdf->Cell(147,5, 'Formato', 0, 1, 'C');

    	$pdf->setXY(53,25);
    	$pdf->SetFont('Times','B',16);
    	$pdf->SetFillColor(191,191,191);
    	$pdf->Cell(147,10, 'Lista de asistencia', 0, 1, 'C',true);

    	$pdf->setXY(53,34);
    	$pdf->SetFont('Times','',9);
    	$pdf->Cell(23,5, 'Fecha de', 0, 1, 'C');
    	$pdf->setXY(53,37);
    	$pdf->Cell(23,5, utf8_decode('Emisión:'), 0, 1, 'C');

    	$pdf->setXY(75,35);
    	$pdf->Cell(23,5, utf8_decode('Revisión:'), 0, 1, 'C');

    	$pdf->setXY(98,35);
    	$pdf->Cell(59,5, utf8_decode('Código:'), 0, 1, 'C');

    	$pdf->setXY(157,35);
    	$pdf->Cell(11,5, utf8_decode('Página:'), 0, 1, 'C');

    	$pdf->setXY(169,35);
    	$pdf->SetFont('Times','B',11);
    	$pdf->Cell(31,5, '', 0, 1, 'C');

    	$pdf->SetFont('Times','B',9);
    	$pdf->setXY(53,41.5);
    	$pdf->Cell(23,5, '040808', 0, 1, 'C');

    	$pdf->setXY(75,41.5);
    	$pdf->Cell(23,5, '00', 0, 1, 'C');

    	$pdf->setXY(98,41.5);
    	$pdf->Cell(59,5, 'FO-CE-03.3', 0, 1, 'C');

    	$pdf->setXY(157,41.5);
    	$pdf->SetFont('Times','',9);
    	$pdf->Cell(11,5, 'De:', 0, 1, 'C');

    	$pdf->setXY(169,41.5);
    	$pdf->SetFont('Times','B',11);
    	$pdf->Cell(31,5, '', 0, 1, 'C');

        $pdf->Image(public_path() . '/images/logo-uniceba.jpg',15,20,38);

    	$pdf->line(15,20,200,20);//Superior
    	$pdf->line(15,20,15,46);//Lateral Izquiera
    	$pdf->line(53,20,53,46);//Centro
    	$pdf->line(200,20,200,46);//Lateral Derecha
    	$pdf->line(15,46,200,46);//Inferior

    	$pdf->line(53,25,200,25);//Interior Superior
    	$pdf->line(53,35,200,35);//Interior Centro
    	$pdf->line(53,42,200,42);//Interior Inferior
    	$pdf->line(75,35,75,46);//Interior Lateral Izquiera
    	$pdf->line(98,35,98,46);//Interior Centro 1
    	$pdf->line(157,35,157,46);//Interior Centro 2
    	$pdf->line(169,35,169,46);//Interior Lateral Derecha

    	$fill = false;

    	//Información de la clase
    	$pdf->setXY(15,50);
    	$pdf->SetFont('Times','B',9);
    	$pdf->Cell(75,5, utf8_decode('PERIODO: ' . $clase -> periodo . ' ' . $clase -> reconocimiento_oficial), 0, 1, 'L',$fill);
    	$pdf->setXY(15,55);
    	$pdf->Cell(75,5, utf8_decode('CATEDRÁTICO: ' . $clase -> nombre . ' ' . $clase -> apaterno . ' ' . $clase -> amaterno), 0, 1, 'L',$fill);
    	$pdf->setXY(15,60);
    	$pdf->Cell(75,5, utf8_decode('ESPECIALIDAD: ' . strtoupper($clase -> nivel_academico . ' EN ' . $clase -> especialidad)), 0, 1, 'L',$fill);
    	$pdf->setXY(15,65);
    	$pdf->Cell(75,5, utf8_decode('MATERIA: ' . strtoupper($clase -> asignatura)), 0, 1, 'L',$fill);
    	$pdf->setXY(15,70);
    	$pdf->Cell(75,5, utf8_decode('GRUPO: ' . $clase -> turno), 0, 1, 'L',$fill);

    	//Tabla calificaciones
    	$pdf->SetFont('Times','',8);
    	$pdf->setXY(150,50);
    	$pdf->Cell(30,5, '', 1, 1, 'L',$fill);
    	$pdf->setXY(150,55);
    	$pdf->Cell(30,5, 'Alumnos Aprobados', 1, 1, 'L',$fill);
    	$pdf->setXY(150,60);
    	$pdf->Cell(30,5, 'Alumnos No Aprobados', 1, 1, 'L',$fill);
    	$pdf->setXY(150,65);
    	$pdf->Cell(30,5, 'Promedio Grupal', 1, 1, 'L',$fill);
    	$pdf->setXY(150,70);
    	$pdf->Cell(30,5, utf8_decode('Firma de Catedrático'), 1, 1, 'L',$fill);
    	$pdf->setXY(180,50);
    	$pdf->Cell(10,5, 'N0.', 1, 1, 'C',$fill);
    	$pdf->setXY(180,55);
    	$pdf->Cell(10,5, '', 1, 1, 'L',$fill);
    	$pdf->setXY(180,60);
    	$pdf->Cell(10,5, '', 1, 1, 'L',$fill);
    	$pdf->setXY(180,65);
    	$pdf->Cell(20,5, '', 1, 1, 'L',$fill);
    	$pdf->setXY(180,70);
    	$pdf->Cell(20,5, '', 1, 1, 'L',$fill);
    	$pdf->setXY(190,50);
    	$pdf->Cell(10,5, '%.', 1, 1, 'C',$fill);
    	$pdf->setXY(190,55);
    	$pdf->Cell(10,5, '', 1, 1, 'L',$fill);
    	$pdf->setXY(190,60);
    	$pdf->Cell(10,5, '', 1, 1, 'L',$fill);

    	//Tabla de estudiantes
    	$pdf->SetFont('Times','B',8);
    	$pdf->setXY(15,80);
    	$pdf->Cell(8,5, '', 1, 1, 'L',$fill);
    	$pdf->setXY(23,80);
    	$pdf->Cell(74,5, 'Estudiante', 1, 1, 'C',$fill);
    	$pdf->setXY(97,80);
    	$pdf->Cell(24,5, 'Mes', 1, 1, 'C',$fill);
    	$pdf->setXY(121,80);
    	$pdf->Cell(24,5, 'Mes', 1, 1, 'C',$fill);
    	$pdf->setXY(145,80);
    	$pdf->Cell(6,5, 'TF', 1, 1, 'C',$fill);
    	$pdf->setXY(151,80);
    	$pdf->Cell(12,5, 'Trabajos', 1, 1, 'C',$fill);
    	$pdf->setXY(163,80);
    	$pdf->Cell(22,5, utf8_decode('Participación'), 1, 1, 'C',$fill);
    	$pdf->setXY(185,80);
    	$pdf->Cell(15,5, 'Total', 1, 1, 'C',$fill);

    	//Lista de estudiantes
    	$y = $pdf -> getY();
    	$pdf->SetFont('Times','',8);
    	foreach ($grupo as $key => $estudiante) {
    		$pdf->setXY(15,$y);
    		$pdf->Cell(8,5, $this -> getNumeroLista($key), 1, 1, 'C',$fill);
    		$pdf->setXY(23,$y);
    		$pdf->Cell(74,5, utf8_decode($estudiante -> nombre), 1, 1, 'L',$fill);
    		//Recuatros de asistencia
    		$x = 97;
    		for ($i=0; $i < 41; $i++) { 
    			$pdf->setXY($x,$y);
    			$pdf->Cell(2,5, '', 1, 1, 'L',$fill);
    			$x += 2;
    			if($i==23)
    				$x += 6;
    		}

	    	$pdf->setXY(145,$y);
	    	$pdf->Cell(6,5, '', 1, 1, 'C',$fill);
	    	$pdf->setXY(185,$y);
	    	$pdf->Cell(15,5, '', 1, 1, 'C',$fill);

    		$y += 5;
    	}

    	$pdf->SetFont('Times','B',12);
    	$pdf->setXY(15,$y);
    	$pdf->Cell(180,5, 'OBSERVACIONES IMPORTANTES:', 0, 1, 'L',$fill);

    	$y += 15;
    	$pdf->SetFont('Times','',11.7);
    	$pdf->setXY(15,$y);
    	$pdf->Cell(180,5, '1.   LISTA DE ALUMNOS VIGENTES EN ESTE GRUPO Y QUE TIENEN DERECHO A LOS SERVICIOS', 0, 1, 'L',$fill);
    	$y += 5;
    	$pdf->setXY(15,$y);
    	$pdf->Cell(180,5, '      EDUCATIVOS QUE OFRECE LA UNICEBA.', 0, 1, 'L',$fill);

    	$y += 15;
    	$pdf->setXY(15,$y);
    	$pdf->Cell(180,5, utf8_decode('2.   EL DOCENTE SÓLO PODRÁ ANOTAR EN LA LISTA DE ASISTENCIA A LOS ALUMNOS QUE'), 0, 1, 'L',$fill);
    	$y += 5;
    	$pdf->setXY(15,$y);
    	$pdf->Cell(180,5, utf8_decode('      PRESENTEN AUTORIZACIÓN EXPRESA DE CONTROL ESCOLAR.'), 0, 1, 'L',$fill);

    	return $pdf;
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

		function getNumeroLista($numero){
      if($numero < 9)
      	return '000' . ($numero + 1);
      return '00' . ($numero + 1);
    }
}
