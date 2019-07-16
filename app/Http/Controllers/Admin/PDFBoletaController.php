<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Kardex;
use App\Models\Estudiante;
use App\Models\Periodo;

date_default_timezone_set('America/Mexico_City');

class PDFBoletaController extends Controller
{
		/**
     * Descarga de pdf para certificado parcial.
     *
     * @author Jacobo Gonzalez Tamayo <girisnotadog@gmail.com>
     * @return pdf
     */
    public function boleta($estudiante_id,$periodo_id,$oportunidad_id) {

    	$boleta = Kardex::getBoleta($estudiante_id,$periodo_id,$oportunidad_id);
    	$promedio = Kardex::getPromedioBoleta($estudiante_id,$periodo_id,$oportunidad_id);
    	$estudiante = Estudiante::getDatosBoleta($estudiante_id);
    	$periodo = Periodo::find($periodo_id );

    	// dd($estudiante);

    	$pdf = new Fpdf('P','mm','Letter');
    	$pdf->AddPage();
    	$pdf->SetFont('Times', 'B', 8);

      // $pdf->Image(public_path() . '/images/pdf base/3.jpg',0,0,216,277);
      $pdf->SetLineWidth(0.1);

    	$pdf->setXY(53,20);
    	$pdf->SetFont('Times','B',12);
    	$pdf->Cell(147,5, 'Formato', 0, 1, 'C');

    	$pdf->setXY(53,25);
    	$pdf->SetFont('Times','B',16);
    	$pdf->SetFillColor(191,191,191);
        switch ($oportunidad_id) {
            case 1:$pdf->Cell(147,10, 'Reporte de Calificaciones Finales', 0, 1, 'C',true);break;
            case 2:$pdf->Cell(147,10, 'Reporte de Calificaciones Finales Extraordinarias', 0, 1, 'C',true);break;
            case 3:$pdf->Cell(147,10, 'Reporte de Calificaciones Finales Especiales', 0, 1, 'C',true);break;
        }

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
    	$pdf->Cell(31,5, '1', 0, 1, 'C');

    	$pdf->SetFont('Times','B',9);
    	$pdf->setXY(53,41.5);
    	$pdf->Cell(23,5, '200619', 0, 1, 'C');

    	$pdf->setXY(75,41.5);
    	$pdf->Cell(23,5, '00', 0, 1, 'C');

    	$pdf->setXY(98,41.5);
    	$pdf->Cell(59,5, 'FO-CE-05.1 ', 0, 1, 'C');

    	$pdf->setXY(157,41.5);
    	$pdf->SetFont('Times','',9);
    	$pdf->Cell(11,5, 'De:', 0, 1, 'C');

    	$pdf->setXY(169,41.5);
    	$pdf->SetFont('Times','B',11);
    	$pdf->Cell(31,5, '1', 0, 1, 'C');

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

    	//Texto
    	$pdf->SetFont('Times','',11.5);
    	$pdf->setXY(15,51);
    	$pdf->Cell(185,5, utf8_decode('CELAYA, GTO., ' . $this  -> obtenerFechaEnLetra(Date('Y-m-d'))), 0, 1, 'R',$fill);

    	$pdf->setXY(15,64);
    	$pdf->Cell(185,5, utf8_decode('La Universidad del Centro del Bajío, hace constar que según documentos probatorios que obran en el archivo de'), 0,1,'J',$fill);

    	$pdf->setXY(15,69);
    	$pdf->Cell(185,5, utf8_decode('esta Universidad, el estudiante:'), 0,1,'J',$fill);

    	$pdf->SetFont('Times','B',15);
    	$pdf->setXY(15,74);
    	$pdf->Cell(185,10, utf8_decode($estudiante -> matricula . '         ' . $estudiante -> apaterno . ' ' . $estudiante -> amaterno . ' ' . $estudiante -> nombre), 0,1,'J',$fill);

    	$pdf->SetFont('Times','',11.5);
    	$pdf->setXY(15,84);
    	$pdf->Cell(185,5, utf8_decode('Quien cursa la ' . $estudiante -> nivel_academico . ' en:'), 0, 1, 'L',$fill);

    	$pdf->SetFont('Times','B',15);
    	$pdf->setXY(15,89);
    	$pdf->Cell(185,10, utf8_decode($estudiante -> especialidad), 0,1,'J',$fill);

    	$pdf->SetFont('Times','',11.5);
    	$pdf->setXY(15,99);
    	$pdf->Cell(185,5, utf8_decode('Segun recononcimiento de Validez Oficial de Estudios de la Dirección General de Educación Superior'), 0, 1, 'L',$fill);

    	$pdf->SetFont('Times','B',15);
    	$pdf->setXY(15,104);
    	$pdf->Cell(185,10, utf8_decode($estudiante -> reconocimiento_oficial . ' CON FECHA DE ' . $this -> obtenerFechaEnLetra($estudiante -> fecha_reconocimiento)), 0,1,'J',$fill);

    	$pdf->SetFont('Times','',11.5);
    	$pdf->setXY(15,114);
    	$pdf->Cell(185,5, utf8_decode('Presento en Examen(es) Ordinario(s) la(s) asignatura(s) y obtuvo la(s) Calificacion(es) que se indica(n)'), 0, 1, 'L',$fill);

    	$pdf->setXY(15,119);
    	$pdf->Cell(185,5, utf8_decode('en el Periodo: ' . $periodo -> reconocimiento_oficial), 0, 1, 'L',$fill);

    	//Título de calificiaciones
    	$pdf->SetFont('Times','',15);
    	$pdf->setXY(15,125);
    	$pdf->Cell(25,10, 'GRADO', 1, 1, 'C',$fill);
    	$pdf->setXY(40,125);
    	$pdf->Cell(120,10, 'ASIGNATURA', 1, 1, 'C',$fill);
    	$pdf->setXY(160,125);
    	$pdf->Cell(40,10, utf8_decode('CALIFICACIÓN'), 1, 1, 'C',$fill);

    	//Calificiaciones
    	$y = $pdf->getY();
	    $pdf->SetFont('Times','',12);
    	foreach ($boleta as $materia) { 
	    	$pdf->setXY(15,$y);
	    	$pdf->Cell(25,10, $materia -> semestre, 1, 1, 'C',$fill);
	    	$pdf->setXY(40,$y);
	    	$pdf->Cell(120,10, utf8_decode($materia -> asignatura), 1, 1, 'L',$fill);
	    	$pdf->setXY(160,$y);
	    	$pdf->Cell(17,10, $materia -> calificacion, 1, 1, 'C',$fill);
	    	$pdf->setXY(177,$y);
	    	$pdf->Cell(23,10, $this -> getNumeroLetra($materia -> calificacion), 1, 1, 'C',$fill);
	    	$y += 10;
    	}

    	//Promedio
    	$pdf->setXY(40,$y);
    	$pdf->Cell(110,10, utf8_decode('PROMEDIO:'), 0, 1, 'R',$fill);
    	$pdf->setXY(160,$y);
    	$pdf->Cell(17,10, $promedio -> promedio, 1, 1, 'C',$fill);

    	$salto = ((265 - $y)/4)-5;
    	$y += $salto * 2;

    	$pdf->SetFont('Times','',11.5);
    	$pdf->setXY(15,$y);
    	$pdf->Cell(185,5, utf8_decode('A petición del interesado y para los fines que a el convengan, se extiende la presente constancia'), 0, 1, 'L',$fill);

    	$y += $salto;
    	$pdf->SetFont('Times','B',11.5);
    	$pdf->setXY(15,$y);
    	if($estudiante -> grupo == 'DISPERSO')
    		$pdf->Cell(185,5, utf8_decode('Disperso'), 0, 1, 'R',$fill);

    	$y += $salto;
    	$pdf->SetFont('Times','',9);
    	$pdf->setXY(15,$y);
    	$pdf->Cell(185,5, utf8_decode('El presente documento es de uso informativo, para su validez oficial, presentarlo para sellarlo en el departamento de Control Escolar'), 0, 1, 'L',$fill);


    	// $pdf->line(15,265,200,265);

    	$pdf->setTitle('Boleta - ' . $estudiante -> matricula , true);
    	$pdf->Output('I', $estudiante -> matricula, true);

    	exit; // Indispensable para que funcione el PDF
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
}
