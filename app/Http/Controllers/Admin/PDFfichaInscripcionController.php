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
use App\Models\TipoDocumentoEstudiante;

date_default_timezone_set('America/Mexico_City');

class PDFfichaInscripcionController extends Controller
{
		/**
     * Descarga de pdf para certificado parcial.
     *
     * @author Jacobo Gonzalez Tamayo <girisnotadog@gmail.com>
     * @return pdf
     */
		public function ficha($estuidante_id) {
      $pdf = new Fpdf('P','mm','Legal');

      $estudiante = Estudiante::getDatosActa($estuidante_id);
      $documentos = TipoDocumentoEstudiante::getDocumentosEstudiante($estuidante_id);
      $documentosLista = TipoDocumentoEstudiante::all();
      // dd($documentos);
      
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
    	$pdf->Cell(31,5, '1', 0, 1, 'C');

    	$pdf->SetFont('Times','B',9);
    	$pdf->setXY(53,41.5);
    	$pdf->Cell(23,5, '040808', 0, 1, 'C');

    	$pdf->setXY(75,41.5);
    	$pdf->Cell(23,5, '00', 0, 1, 'C');

    	$pdf->setXY(98,41.5);
    	$pdf->Cell(59,5, 'FO-CE-01.2', 0, 1, 'C');

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

    	//Parte superior títulos
    	$pdf->SetFont('Times','B',9);

    	$pdf->setXY(15,55);
    	$pdf->Cell(110,5, 'ANTONIO GARCIA CUBAS 704, COL. FOVISSSTE, CELAYA, GTO.', 0, 1, 'L',$fill);

    	$pdf->setXY(15,60);
    	$pdf->Cell(110,5, 'TELS 611-74-70, 612-98-32, 612-57-87 y 611-68-53', 0, 1, 'L',$fill);

    	$pdf->SetFont('Times','B',11);
    	$pdf->setXY(169,50);
    	$pdf->Cell(31,5, utf8_decode('MATRÍCULA'), 1, 1, 'C',$fill);

    	$pdf->SetFont('Times','B',18);
    	$pdf->setXY(169,55);
    	$pdf->Cell(31,10, $estudiante -> matricula, 1, 1, 'C',$fill);


    	$pdf->SetFont('Times','B',9);

    	$pdf->setXY(15,67);
    	$pdf->Cell(80,5, utf8_decode($estudiante -> nivel_academico), 1, 1, 'C',$fill);

    	$pdf->setXY(95,67);
    	$pdf->Cell(30,5, 'Grupo', 1, 1, 'C',$fill);

    	$pdf->setXY(125,67);
    	$pdf->Cell(30,5, 'Horario', 1, 1, 'C',$fill);

    	$pdf->setXY(155,67);
    	$pdf->Cell(25,5, 'Ciclo', 1, 1, 'C',$fill);

    	$pdf->setXY(180,67);
    	$pdf->Cell(20,5, 'Recibo', 1, 1, 'C',$fill);

    	$pdf->SetFont('Times','',9);

    	$pdf->setXY(15,72);
    	$pdf->Cell(80,5, utf8_decode($estudiante -> especialidad), 1, 1, 'C',$fill);

    	$pdf->setXY(95,72);
    	$pdf->Cell(30,5, $estudiante -> grupo, 1, 1, 'C',$fill);

    	$pdf->setXY(125,72);
    	$pdf->Cell(30,5, '', 1, 1, 'C',$fill);

    	$pdf->setXY(155,72);
    	$pdf->Cell(25,5, $estudiante -> periodo, 1, 1, 'C',$fill);

    	$pdf->setXY(180,72);
    	$pdf->Cell(20,5, '', 1, 1, 'C',$fill);

    	//Datos generales Títulos
    	$pdf->SetFont('Times','B',15);

    	$pdf->setXY(15,77);
    	$pdf->Cell(185,10, 'GENERALES DEL SOLICITANTE', 0, 1, 'l',$fill);

    	$pdf->SetFont('Times','B',9);
    	$pdf->setXY(15,87);
    	$pdf->Cell(185,4, 'Nombre completo', 1, 1, 'C',$fill);

    	$pdf->setXY(15,97);
    	$pdf->Cell(80,4, utf8_decode('Fecha de Nacimiento (año, mes, día)'), 1, 1, 'C',$fill);

    	$pdf->setXY(95,97);
    	$pdf->Cell(35,4, utf8_decode('Estado Civil'), 1, 1, 'C',$fill);

    	$pdf->setXY(130,97);
    	$pdf->Cell(35,4, utf8_decode('Nacionalidad'), 1, 1, 'C',$fill);

    	$pdf->setXY(165,97);
    	$pdf->Cell(35,4, utf8_decode('Sexo'), 1, 1, 'C',$fill);

    	$pdf->setXY(15,107);
    	$pdf->Cell(92.5,4, utf8_decode('Calle y Número'), 1, 1, 'C',$fill);

    	$pdf->setXY(107.5,107);
    	$pdf->Cell(92.5,4, utf8_decode('Colonia'), 1, 1, 'C',$fill);

    	$pdf->setXY(15,117);
    	$pdf->Cell(62,4, utf8_decode('Ciudad'), 1, 1, 'C',$fill);

    	$pdf->setXY(77,117);
    	$pdf->Cell(61,4, utf8_decode('Estado'), 1, 1, 'C',$fill);

    	$pdf->setXY(138,117);
    	$pdf->Cell(62,4, utf8_decode('Teléfono'), 1, 1, 'C',$fill);

    	//Datos generales Datos
    	$pdf->SetFont('Times','',11);
    	$pdf->setXY(15,91);
    	$pdf->Cell(185,6, utf8_decode($estudiante -> apaterno . ' ' . $estudiante -> amaterno . ' ' . $estudiante -> nombre), 1, 1, 'C',$fill);

    	$pdf->setXY(15,101);
    	$pdf->Cell(80,6, utf8_decode($estudiante -> fecha_nacimiento), 1, 1, 'C',$fill);

    	$pdf->setXY(95,101);
    	$pdf->Cell(35,6, utf8_decode($estudiante -> estado_civil), 1, 1, 'C',$fill);

    	$pdf->setXY(130,101);
    	$pdf->Cell(35,6, utf8_decode($estudiante -> nacionalidad), 1, 1, 'C',$fill);

    	$pdf->setXY(165,101);
    	$pdf->Cell(35,6, utf8_decode(($estudiante -> sexo == 'M')?'Hombre':'Mujer'), 1, 1, 'C',$fill);

    	$pdf->setXY(15,111);
    	$pdf->Cell(92.5,6, utf8_decode($estudiante -> calle_numero), 1, 1, 'C',$fill);

    	$pdf->setXY(107.5,111);
    	$pdf->Cell(92.5,6, utf8_decode($estudiante -> colonia), 1, 1, 'C',$fill);

    	$pdf->setXY(15,121);
    	$pdf->Cell(62,6, utf8_decode($estudiante -> localidad), 1, 1, 'C',$fill);

    	$pdf->setXY(77,121);
    	$pdf->Cell(61,6, utf8_decode($estudiante -> estado), 1, 1, 'C',$fill);

    	$pdf->setXY(138,121);
    	$pdf->Cell(62,6, utf8_decode($estudiante -> telefono_personal), 1, 1, 'C',$fill);

    	//Doxumentos
    	$pdf->SetFont('Times','B',15);

    	$pdf->setXY(15,127);
    	$pdf->Cell(185,10, 'EXPEDIENTE ESCOLAR', 0, 1, 'L',$fill);

    	$pdf->SetFont('Times','B',9);
    	$pdf->setXY(15,137);
    	$pdf->Cell(15,4, '', 1, 1, 'C',$fill);
    	$pdf->setXY(30,137);
    	$pdf->Cell(57,4, utf8_decode('Documentación'), 1, 1, 'C',$fill);
    	$pdf->setXY(87,137);
    	$pdf->Cell(56,4, utf8_decode('Fecha de ingrso (año, mes, día)'), 1, 1, 'C',$fill);
    	$pdf->setXY(143,137);
    	$pdf->Cell(57,4, utf8_decode('Fecha de salida (año, mes, día)'), 1, 1, 'C',$fill);

        // dd($documentosLista);
        $y = $pdf->getY();
        foreach ($documentosLista as $documento) {
        	$pdf->SetFont('Times','',11);
        	$pdf->setXY(15,$y);
        	$pdf->Cell(15,6, $this -> searchDocument($documentos,$documento->id), 1, 1, 'C',$fill);
        	$pdf->setXY(30,$y);
        	$pdf->Cell(57,6, utf8_decode($documento -> tipo_documento), 1, 1, 'L',$fill);
        	$pdf->setXY(87,$y);
        	$pdf->Cell(56,6,'', 1, 1, 'L',$fill);
        	$pdf->setXY(143,$y);
        	$pdf->Cell(57,6, '', 1, 1, 'L',$fill);
            $y +=6;
        }

    	//Datos restantes
        $y += 5;
    	$pdf->setXY(15,$y);
    	$pdf->Cell(15,5, utf8_decode('¿Reliza Equivalencia?'), 0, 1, 'L',$fill);
        $y += 5;
    	$pdf->setXY(15,$y);
    	$pdf->Cell(5,5, '', 1, 1, 'L',$fill);
    	$pdf->setXY(20,$y);
    	$pdf->Cell(10,5, utf8_decode('SI'), 0, 1, 'L',$fill);
    	$pdf->setXY(30,$y);
    	$pdf->Cell(5,5, '', 1, 1, 'L',$fill);
    	$pdf->setXY(35,$y);
    	$pdf->Cell(10,5, 'No', 0, 1, 'L',$fill);
        $y -= 5;
    	$pdf->setXY(160,$y);
    	$pdf->Cell(15,5, utf8_decode('Causal'), 0, 1, 'L',$fill);
        $y += 5;
    	$pdf->setXY(160,$y);
    	$pdf->Cell(5,5, '', 1, 1, 'L',$fill);
    	$pdf->setXY(165,$y);
    	$pdf->Cell(10,5, utf8_decode('Baja'), 0, 1, 'L',$fill);
    	$pdf->setXY(175,$y);
    	$pdf->Cell(5,5, '', 1, 1, 'L',$fill);
    	$pdf->setXY(180,$y);
    	$pdf->Cell(10,5, utf8_decode('Titulación'), 0, 1, 'L',$fill);

        $y += 10;
    	$pdf->setXY(15,$y);
    	$pdf->Cell(185,5, utf8_decode('ESTADO DONDE CURSO SU: XXXXXXXX '), 1, 1, 'L',$fill);
        $y += 5;
    	$pdf->setXY(15,$y);
    	$pdf->Cell(185,5, utf8_decode('MEDIO POR EL CUAL SE ENTERO DE ESTA INSTITUCIÓN: ' . $estudiante -> medio_enterado), 1, 1, 'L',$fill);
        $y += 5;
    	$pdf->setXY(15,$y);
    	$pdf->Cell(92.5,5, utf8_decode('LUGAR DONDE TRABAJA: ' . $estudiante -> empresa), 1, 1, 'L',$fill);
    	$pdf->setXY(107.5,$y);
    	$pdf->Cell(92.5,5, utf8_decode('PUESTO: ' . $estudiante -> puesto), 1, 1, 'L',$fill);

    	//IMPORTANTE
        $y += 10;
    	$pdf->SetFont('Times','B',11);
    	$pdf->setXY(15,$y);
    	$pdf->MultiCell(185,5, utf8_decode('IMPORTANTE: El plazo máximo para entregar documentos sera de tres meses contados a partir de la fecha de Inscripción, el no cumplir con este requerimiento será causa de baja escolar.'), 0, 'J',$fill);
        $y +=15;
    	$pdf->setXY(15,$y);
    	$pdf->MultiCell(185,5, utf8_decode('Estoy de acuerdo y conforme con las condiconesgenerales que establce esta institución como son el formato de Condiciones Generales, Normatividad General y el Calendario Escolar vigentes.'), 0, 'J',$fill);

    	$y += 15;

    	$pdf->SetFont('Times','I',11);
    	$pdf->setXY(15,$y);
    	$pdf->MultiCell(185,5, utf8_decode('De igual forma Si (  ) No (  ) autorizo a las autoridades educativas y directivos escolares del plantel particular, para que los datos personales que se recaben con objeto del presente formato, puedan ser difundidos de manera pública o transferidos a otras autoridades e instituciones  educativas y no educativas, con el fin de que sea posible validar la autenticidad de los certificados, diplomas, títulos o grados que se expiden a mi favor. En estos casos, solo serán publicaos los datos mínimos indispensables para realizar la verificación de autenticidad del documento, y de ninguna manera se difundirán datos sensibles.'), 0, 'J',$fill);

    	//Firmas
    	$y += 30;
    	$pdf->SetFont('Times','B',9);
    	$pdf->setXY(15,$y);
    	$pdf->Cell(92.5,15,'', 1, 1, 'L',$fill);
    	$pdf->setXY(107.5,$y);
    	$pdf->Cell(92.5,15,'', 1, 1, 'L',$fill);
    	$y += 15;
    	$pdf->setXY(15,$y);
    	$pdf->Cell(92.5,4,'CONTROL ESCOLAR', 1, 1, 'C',$fill);
    	$pdf->setXY(107.5,$y);
    	$pdf->Cell(92.5,4,'FIRMA DEL ALUMNO', 1, 1, 'C',$fill);

    	//Leyenda final
    	$y += 5;
			$pdf->setXY(15,$y);
    	$pdf->SetFont('Times','I',8);
    	$pdf->MultiCell(185,5, utf8_decode('El Inicio de clases es el dia XXXXX, ## DE XXXXX DE #### a las 00:00 am en las instalaciones ubicadas en Antonio Garcia Cubas No. 704'), 0, 'J',$fill);




      $pdf->setTitle('Lista de asistencia ', true);
      $pdf->Output('I', 'Lista de asistencia ', true);

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

		function searchDocument($documentos,$documento_id){
      foreach ($documentos as $documento) {
      	if($documento -> tipo_documento_id == $documento_id)
      		return 'X';
      }
      return '';
    }
}
