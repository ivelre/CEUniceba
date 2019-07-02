<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Clase;
use App\Models\Kardex;
use App\Models\FechaCertificado;

class PDFController extends Controller
{
		/**
     * Descarga de pdf para certificado parcial.
     *
     * @author Jacobo Gonzalez Tamayo <girisnotadog@gmail.com>
     * @return pdf
     */
    public function certificado($tipo_certificado,$id_estudiante, $no_certificado, $id_fecha_certificado) {
    	// PREPARACIÓN DE INFORMACIÓN
    	$estudiante = Estudiante::find($id_estudiante);
    	$datos_estudiante = $estudiante -> getDatosGenerales()->first();
    	$especialidad = $estudiante->getEspecialidad()->first();
    	$semestres = $estudiante->getSemestres();
      $fecha = FechaCertificado::find($id_fecha_certificado) -> fecha_certificado;

      $certificado = new \StdClass;
      $certificado -> no_certificado = $no_certificado;
      $certificado -> tipo_certificado = $tipo_certificado;
      $total_materias = 0;
      $minima_aprobatoria = 6;
      $tipoAlumno = 1;
      $tipoMateria = true;
      $fontsize = ($especialidad -> nivel_academico_id == 1)?8:10;
      $longString = ($especialidad -> nivel_academico_id == 1)?39:30;
      switch ($especialidad -> nivel_academico_id) {
        case 1: $minima_aprobatoria = 6;break;
        case 2: $minima_aprobatoria = 7;break;
        case 3: $minima_aprobatoria = 8;break;
      }

      // dd($especialidad);

    	// $certificado = $datos_estudiante -> getCertificadoTotal();

    	// GENERACIÓN DEL DOCUMENTO

    	$pdf = new Fpdf('P','mm','Letter');
    	$pdf->AddPage();
    	$pdf->SetFont('Times', 'B', 8);

      //$pdf->Image(public_path() . '/images/pdf base/1.png',0,0,216,277);
    	// No. de certificado
    	$pdf->setXY(164, 18); $pdf->Cell(50, 8, 'CERTIFICADO No:');
      $pdf->SetLineWidth(0.1);
    	$pdf->line(191,23,203,23);
    	$pdf->setXY(190, 17);
    	$pdf->Cell(13,8, $certificado -> no_certificado, 0, 1, 'R');

    	// Encabezado
    	$pdf->setXY(63, 25);
    	$pdf->SetFont('Times', 'B', 18);
    	$pdf->SetTextColor(100, 82, 163);
    	$pdf->Cell(50, 10, utf8_decode('UNIVERSIDAD DEL CENTRO DEL BAJÍO'),0);
    	$pdf->SetTextColor(0, 0, 0);

    	// Logotipo
    	$pdf->Image(public_path() . '/images/logo_uniceba.png', 5, 25, 48);

    	// Leyenda
    	$pdf->SetFont('Helvetica', '', 10);
    	$pdf->setXY(55, 37);
    	$pdf->Cell(28, 8, 'HACE CONSTAR QUE');
    	$pdf->line(93, 43, 203, 43);
      //
    	$pdf->setXY(55, 42);
    	$pdf->Cell(28, 8, utf8_decode('CURSÓ Y ACREDITÓ '));
    	$pdf->line(92, 48, 203, 48);
      //
    	$pdf->setXY(55, 47);
    	$pdf->Cell(138, 8, utf8_decode('CON  RECONOCIMIENTO  DE  VALIDEZ  OFICIAL    DE  ESTUDIOS  DE  LA  SECRETARÍA'));
      //
    	$pdf->setXY(55, 52);
    	$pdf->Cell(138, 8, utf8_decode('DE EDUCACIÓN PÚBLICA, SEGÚN ACUERDO No.                                                             DE'));
    	$pdf->line(139, 57, 197, 57);
      //
    	$pdf->setXY(55, 57);
    	$pdf->Cell(138, 8, 'FECHA');
    	$pdf->line(69, 62, 139, 62);
     //
    	$pdf->setXY(138, 57);
    	$pdf->Cell(62, 8, 'Y CLAVE DE REGISTRO DEL PLAN DE', 0, 0, 'J');
      //
    	$pdf->setXY(55, 62);
    	$pdf->Cell(138, 8, 'ESTUDIOS                                     .');
    	$pdf->line(75, 67 , 110, 67 );

    	// Texto de relleno
    	$pdf->SetFont('Times', 'B', 9);
    	$pdf->setXY(95, 37);
    	$pdf->Cell(162, 8, utf8_decode("$datos_estudiante->nombre $datos_estudiante->apaterno $datos_estudiante->amaterno"));

     switch ($especialidad->nivel_academico_id) {
       case 1://LICENCIATURA
         $especialidad->especialidad = 'LA LICENCIATURA EN ' . $especialidad->especialidad;
         break;
       case 2://MAESTRIA
         $especialidad->especialidad = 'LA MAESTRIA EN ' . $especialidad->especialidad;
         break;
       case 3://DOCTORADO
         $especialidad->especialidad = 'EL DOCTORADO EN ' . $especialidad->especialidad;
         break;
       case 4://TECNICO
         $especialidad->especialidad = 'TECNICO EN ' . $especialidad->especialidad;
         break;
     }
      $pdf->setXY(93, 42);
      if(strlen($especialidad->especialidad) > 48)
          $pdf->SetFont('Times', 'B', 8);
      $pdf->Cell(150, 8, utf8_decode($especialidad->especialidad));
      $pdf->SetFont('Times', 'B', 9);
    	$pdf->setXY(139, 51);
    	$pdf->Cell(59, 8, $especialidad->reconocimiento_oficial, 0, 0, 'C');
    	$pdf->setXY(68, 56);
    	$pdf->Cell(71, 8, env('FECHA_ACUERDO_SEP', $this -> obtenerFechaEnLetra($especialidad->fecha_reconocimiento)), 0, 0, 'C');
    	$pdf->setXY(73, 61);
    	$pdf->Cell(37, 8, $especialidad->dges, 0, 0, 'C');
    	
    	// Foto del alumno? // Se pega la fotografía una vez impreso el certificado
    	$pdf->Image(public_path() . '/images/marco_foto.jpeg', 15, 97, 25);

    	// Firma del alumno
			$pdf->setXY(14, 195);
    	$pdf->SetFont('Times', '', 8);
    	$pdf->Cell(150, 8, 'Firma del Alumno');
    	$pdf->line(12, 196, 38, 196);

    	//Tabla de resultados
    	$pdf->SetFont('Times', 'B', 14);
    	$pdf->setXY(83, 75);
    	if($certificado->tipo_certificado == 'total') {
    		$pdf->Cell(88, 8, 'CERTIFICADO DE ESTUDIOS TOTALES');
    	}elseif($certificado->tipo_certificado == 'parcial'){
    		$pdf->Cell(88, 8, 'CERTIFICADO DE ESTUDIOS PARCIALES');
    	}

    	$pdf->SetFont('Times', 'B', 8);
    	$pdf->SetFillColor(100,82,163);
    	$pdf->SetTextColor(255,255,255);
    	$pdf->setXY(56, 84);
    	$pdf->Cell(15, 7, 'CLAVE', 0, 0, 'C', 1);
    	$pdf->Cell(58, 7, 'NOMBRE DE LA ASIGNATURA', 0, 0, 'C', 1);

    	$pdf->setFontSize(6);
    	$pdf->Cell(15, 7,'CICLO EN', 0, 0, 'C', 1);

      $pdf->setFontSize(8);
      
      $pdf->setXY(144, 84);
      $pdf->Cell(28, 7, utf8_decode('CALIFICACIÓN'), 0, 0, 'C', 1);
      $pdf->Cell(32, 7, 'OBSERVACIONES', 0, 0, 'C', 1);

      $pdf->setFontSize(6);
    	$pdf->setXY(129, 86);
    	$pdf->Cell(15, 7,'QUE SE CURSO', 0, 0, 'C', 0);

    	//Franja gris
    	$pdf->setXY(56, 91);
    	$pdf->SetFillColor(211,211,213);
    	$pdf->Cell(148, 5, '', 0, 0, 'C', 1);

    	$pdf->SetTextColor(0,0,0);
    	$pdf->setXY(144, 91);
    	$pdf->setFontSize(6);
    	$pdf->Cell(14, 6, utf8_decode('NÚMERO'), 0, 0, 'C');
    	$pdf->Cell(14, 6, 'LETRA', 0, 0, 'C');

      // Imagen de fondo
      $pdf->Image(public_path() . '/images/fondo_certificado.png', 56, 96, 148,169);

    	// Lineas de la tabla
    	$pdf->setDrawColor(100, 83, 163);
      $pdf->setLineWidth(0.3);
    	$pdf->line(56, 85, 56, 265);
    	$pdf->line(73, 85, 73, 265);
    	$pdf->line(129, 91, 129, 265);
    	$pdf->line(144, 91, 144, 265);
    	$pdf->line(158, 91, 158, 265);
    	$pdf->line(172, 85, 172, 265);
    	$pdf->line(204, 85, 204, 265);
    	$pdf->line(56, 265, 204, 265);//Ultima linea

    	// Calificaciones de los semestres
			$pdf->setY(95);

      // dd($semestres);
			// Página 1
      $displaySemestres = ($especialidad -> nivel_academico_id == 1)? array_slice($semestres, 0, 5, 1) : array_slice($semestres, 0, 3, 1);
    	foreach ( $displaySemestres as $semestre => $materias) {
        usort($materias, array('App\Http\Controllers\Admin\PDFController','cmp'));
        $pdf->ln();
        if($especialidad -> nivel_academico_id != 1)
          $pdf->setY($pdf->getY() + 15);
        else{
          if( $especialidad -> id == 16 || $especialidad -> id == 32 )
            $pdf->setY($pdf->getY() - 3);
        }
        $pdf->setX(73);
        $pdf->SetFont('Times', 'B', $fontsize + 1);
        $pdf->Cell(56, 4, utf8_decode($semestre), 0, 1, 'L');
        if($especialidad -> nivel_academico_id != 1)
          $pdf->ln();

        foreach ($materias as $materia) {
          $pdf->SetFont('Times', '', $fontsize-2);
    			$total_materias++;
          $outLine = false;
          $nombreAsignatura = '';
  				$pdf->setX(56);
    			$pdf->Cell(17, 4, $materia->clave,0,0,'C');

          $pdf->SetFont('Times', '', $fontsize);
                if(strlen($materia->nombre_asignatura) > $longString){
                    //$pdf->Cell(56, 4, substr(utf8_decode($materia->nombre_asignatura),0,39),0,0,'L');
                    //$outLine = true;
                  $pdf->SetFont('Times', '', $fontsize - 1 );
                  if(strlen($materia->nombre_asignatura) >= 41){
                    $nombreAsignatura = utf8_decode($materia->nombre_asignatura);
                    $arrayNombreAsignatura = explode(" ", $nombreAsignatura);
                    $parteUnoNombreAsignatura = '';
                    $parteDosNombreAsignatura = '';
                    $parteDos = false;
                    for ($i=0; $i < count($arrayNombreAsignatura); $i++) { 
                      if(strlen($parteUnoNombreAsignatura . ' ' . $arrayNombreAsignatura[$i])<41 && !$parteDos)
                        $parteUnoNombreAsignatura = $parteUnoNombreAsignatura .' ' . $arrayNombreAsignatura[$i];
                      else{
                        $parteDosNombreAsignatura  = $parteDosNombreAsignatura .' ' . $arrayNombreAsignatura[$i];
                        $parteDos = true;
                      }
                    }
                    $pdf->Cell(56, 4, $parteUnoNombreAsignatura,0,0,'L');
                    $outLine = true;
                  }else 
                    $pdf->Cell(56, 4, utf8_decode($materia->nombre_asignatura),0,0,'L');
                }
                else{
                  $pdf->Cell(56, 4, utf8_decode($materia->nombre_asignatura),0,0,'L');
                  }
          $pdf->SetFont('Times', '', $fontsize);
          
          if($materia->ciclo == '00/1'){
            $tipoMateria = false;
            $tipoAlumno = 2;
          }
          elseif($materia->ciclo == '00/2'){
            $tipoMateria = false;
            $tipoAlumno = 3;
          }else
            $tipoMateria = true;
    			$pdf->Cell(15, 4, ($tipoMateria)? $materia->ciclo : '' ,0,0,'C');
    			$pdf->Cell(14, 4, utf8_decode($materia->calificacion),0,0,'C');
    			$pdf->Cell(14, 4, $materia->calificacion_letra,0,0,'C');
          $fechaEER = ($materia->fecha_examen != null)?date("d/m/y", strtotime($materia->fecha_examen )):'';
          $fechaEER = ($materia->oportunidad == "REC.")?'':$fechaEER;
    			$pdf->Cell(32, 4, ($materia->oportunidad != "Normal")? $materia->oportunidad . ' ' . $fechaEER : '',0,1,'L');

          if($outLine){
              $pdf->SetFont('Times', '', $fontsize - 1 );
              $pdf->setX(56);
              $pdf->Cell(17, 4, '',0,0,'L');
              $pdf->Cell(56, 4, $parteDosNombreAsignatura,0,0,'L');
              $pdf->ln();
          }
    		}
    	}

    	$pdf->setFontSize(8);
      $minMaterias = ($especialidad -> nivel_academico_id == 1)? 5:3;
    	if(sizeof($displaySemestres) < $minMaterias) {
        $pdf->setX(56);
        $pdf->Cell(17, 5, '********',0,0,'C');
        $pdf->Cell(56, 5, '************************************',0,0,'C');
        $pdf->Cell(15, 5, '******',0,0,'C');
        $pdf->Cell(14, 5, '******',0,0,'C');
        $pdf->Cell(14, 5, '******',0,0,'C');
        $pdf->Cell(32, 5, '*****************',0,1,'C');

        if($tipoAlumno != 1){
          $pdf->setX(56);
          $pdf->Cell(119, 5, '',0,0,'C');
          $pdf->SetFont('Times', 'B',8);
          $textLeyenda =(($tipoAlumno != 2)?'* OFICIO NO. ':'** OFICIO DE EQUIVALENCIA: ' ) . 
                        (($materia -> folio != null)? $materia -> folio . ' FOLIO ':'') . 
                        (($materia -> expediente != null)? $materia -> expediente . ' EXPEDIENTE':'') . 
                        ' DE FECHA ' . $this -> obtenerFechaEnLetra($materia -> fecha) . '.';
          $pdf->MultiCell(29, 3, $textLeyenda,0,'L',false);
        }

        if($certificado -> tipo_certificado == 'parcial'){
          $pdf->setDrawColor(0, 0, 0);
          $lineY = $pdf->getY();
          $pdf->Line(59,$lineY,200,$lineY);
          $pdf->Line(200,$lineY,200,260);
          $pdf->Line(59,$lineY,200,260);
        }

			}

			// Página 2
    	$pdf->AddPage();

      //$pdf->Image(public_path() . '/images/pdf base/2.png',0,0,216,277);

    	//Tabla de resultados
      $pdf->setDrawColor(100, 83, 163);
    	$pdf->SetFont('Times', 'B', 8.5);
    	$pdf->SetFillColor(100,83,163);
    	$pdf->SetTextColor(255,255,255);
    	$pdf->setXY(10, 21);
    	$pdf->Cell(15, 7, 'CLAVE', 1, 0, 'C', 1);
    	$pdf->Cell(58, 7, 'NOMBRE DE LA ASIGNATURA', 1, 0, 'C', 1);

    	$pdf->setFontSize(6);
    	$pdf->Cell(15, 7,'CICLO EN', 1, 0, 'C', 1);

      
      $pdf->setFontSize(8.5);
      $pdf->setXY(98, 21);
      $pdf->Cell(28, 7, utf8_decode('CALIFICACIÓN'), 1, 0, 'C', 1);
      $pdf->Cell(32, 7, 'OBSERVACIONES', 1, 0, 'C', 1);

      $pdf->setFontSize(6);
    	$pdf->setXY(83, 23);
      $pdf->Cell(15, 7,'QUE SE CURSO', 0, 0, 'C', 0);

    	//Franja gris
    	$pdf->setXY(10, 28);
    	$pdf->SetFillColor(211,211,213);
    	$pdf->Cell(148, 5, '', 0, 0, 'C', 1);

      $pdf->SetTextColor(0,0,0);
      $pdf->setXY(98, 28);
      $pdf->setFontSize(6);
      $pdf->Cell(14, 6, utf8_decode('NÚMERO'), 0, 0, 'C');
      $pdf->Cell(14, 6, 'LETRA', 0, 0, 'C');

    	// Imagen de fondo
    	$pdf->Image(public_path() . '/images/fondo_certificado.png', 10, 32, 148,146);

    	// Lineas de la tabla
    	$pdf->setDrawColor(100, 83, 163);
    	$pdf->setLineWidth(0.3);
    	$pdf->line(10, 23, 10, 178);
    	$pdf->line(27, 22, 27, 178);
    	$pdf->line(83, 28, 83, 178);
    	$pdf->line(98, 28, 98, 178);
    	$pdf->line(112, 28, 112, 178);
    	$pdf->line(126, 22, 126, 178);
    	$pdf->line(158, 22, 158, 178);
    	$pdf->line(10, 178, 158, 178);//Ultima linea
    	
			$pdf->setY(34);
      $displaySemestres = ($especialidad -> nivel_academico_id == 1)? array_slice($semestres, 5, 5, 1) : array_slice($semestres, 3, 1, 1);
    	foreach ($displaySemestres as $semestre => $materias) {
        usort($materias, array('App\Http\Controllers\Admin\PDFController','cmp'));
        $pdf->ln();
        if($especialidad -> nivel_academico_id != 1)
          $pdf->setY($pdf->getY() + 15);
				$pdf->setX(27);
    		$pdf->SetFont('Times', 'B',$fontsize + 1 );
  			$pdf->Cell(56, 4, utf8_decode($semestre), 0, 1, 'L');
        if($especialidad -> nivel_academico_id != 1)
          $pdf->ln();

        foreach ($materias as $materia) {
    		  $pdf->SetFont('Times', '', $fontsize-2);
    			$total_materias ++;
          $outLine = false;
  				$pdf->setX(10);
    			$pdf->Cell(17, 4, $materia->clave,0,0,'C');
          $pdf->SetFont('Times', '', $fontsize);
          if(strlen($materia->nombre_asignatura) > 37){
              // $pdf->Cell(56, 4, substr(utf8_decode($materia->nombre_asignatura),0,37),0,0,'L');
              // $outLine = true;
              $pdf->SetFont('Times', '', 7);
              if(strlen($materia->nombre_asignatura) > 53){
                $nombreAsignatura = utf8_decode($materia->nombre_asignatura);
                $arrayNombreAsignatura = explode(" ", $nombreAsignatura);
                $parteUnoNombreAsignatura = '';
                $parteDosNombreAsignatura = '';
                $parteDos = false;
                for ($i=0; $i < count($arrayNombreAsignatura); $i++) { 
                  if(strlen($parteUnoNombreAsignatura . ' ' . $arrayNombreAsignatura[$i])<53 && !$parteDos)
                    $parteUnoNombreAsignatura = $parteUnoNombreAsignatura .' ' . $arrayNombreAsignatura[$i];
                  else{
                    $parteDosNombreAsignatura  = $parteDosNombreAsignatura .' ' . $arrayNombreAsignatura[$i];
                    $parteDos = true;
                  }
                }
                $pdf->Cell(56, 4, $parteUnoNombreAsignatura,0,0,'L');
                $outLine = true;
              }
              else
                $pdf->Cell(56, 4, utf8_decode($materia->nombre_asignatura),0,0,'L');
          }
          else
    			    $pdf->Cell(56, 4, utf8_decode($materia->nombre_asignatura),0,0,'L');
              $pdf->SetFont('Times', '', $fontsize);

          if($materia->ciclo == '00/1'){
            $tipoMateria = false;
            $tipoAlumno = 2;
          }
          elseif($materia->ciclo == '00/2'){
            $tipoMateria = false;
            $tipoAlumno = 3;
          }else
            $tipoMateria = true;
    			$pdf->Cell(15, 4, ($tipoMateria)? $materia->ciclo : '' ,0,0,'C');
    			$pdf->Cell(14, 4, utf8_decode($materia->calificacion),0,0,'C');
    			$pdf->Cell(14, 4, $materia->calificacion_letra,0,0,'C');
          $fechaEER = ($materia->fecha_examen != null)?date("d/m/y", strtotime($materia->fecha_examen )):'';
          $fechaEER = ($materia->oportunidad == "REC.")?'':$fechaEER;
    			$pdf->Cell(32, 4, ($materia->oportunidad != "Normal")? $materia->oportunidad . ' ' . $fechaEER : '',0,1,'L');

          if($outLine){
              $pdf->SetFont('Times', '', $fontsize - 1 );
              $pdf->Cell(17, 4, '',0,0,'L');
              $pdf->Cell(56, 4, $parteDosNombreAsignatura,0,0,'L');
              $pdf->ln();
          }
    		}
        $pdf->ln(0.0001);
    	}

    	$pdf->setFontSize(8);$minMaterias = ($especialidad -> nivel_academico_id == 1)? 5:3;
      if(sizeof($displaySemestres) < $minMaterias) {
		  	$pdf->setX(10);
				$pdf->Cell(17, 5, '********',0,0,'C');
				$pdf->Cell(56, 5, '************************************',0,0,'C');
				$pdf->Cell(15, 5, '******',0,0,'C');
				$pdf->Cell(14, 5, '******',0,0,'C');
				$pdf->Cell(14, 5, '******',0,0,'C');
				$pdf->Cell(32, 5, '*****************',0,1,'C');
        if($tipoAlumno != 1){
          //* OFICIO NO. 1875/18 *folio 01E3S4180000307 EXPEDIENTE DE FECHA 19 DE JULIO DE 2018*FECHA*
          $pdf->setX(10);
          $pdf->Cell(119, 5, '',0,0,'C');
          $pdf->SetFont('Times', 'B',8);
          $textLeyenda =(($tipoAlumno != 2)?'* OFICIO NO. ':'** OFICIO DE EQUIVALENCIA: ' ) . 
                        (($materia -> folio != null)? $materia -> folio . ' FOLIO ':'') . 
                        (($materia -> expediente != null)? $materia -> expediente . ' EXPEDIENTE':'') . 
                        ' DE FECHA ' . $this -> obtenerFechaEnLetra($materia -> fecha) . '.';
          $pdf->MultiCell(29, 3, $textLeyenda,0,'L',false);
          // $pdf->setX(10);
          // $pdf->Cell(116, 5, '',0,0,'C');
          // $pdf->Cell(32, 5, utf8_decode('se llenará posteriormente'),0,1,'J');
        }
			}
      if($certificado -> tipo_certificado == 'parcial'){
        $pdf->setDrawColor(0, 0, 0);
        $lineY = $pdf->getY();
        $pdf->Line(13,$lineY,154,$lineY);
        $pdf->Line(154,$lineY,154,174);
        $pdf->Line(13,$lineY,154,174);
      }

			// Texto de pie de página
			$pdf->SetFont('Helvetica', '', 9);
			$pdf->SetXY(9,184);
			$pdf->Cell(180, 6, 'EL PRESENTE CERTIFICADO _________________ AMPARA __________________ ASIGNATURAS.', 0, 1);
      $pdf->SetXY(9,189);
			$pdf->Cell(180, 6, utf8_decode('LA ESCALA DE CALIFICACIONES ES DE  5  A  10  Y  LA  MÍNIMA  APROBATORIA ES DE _________'), 0, 1);
      $pdf->SetXY(9,194);
			$pdf->Cell(180, 6, 'CELAYA GUANAJUATO A ____________________________.', 0, 1);

			//Texto de relleno de pie de página
			$pdf->SetFont('Times', 'B', 9);
			$pdf->setXY(55, 183);
			$pdf->Cell(30, 6, strtoupper($certificado->tipo_certificado), 0, 0, 'C');
			$pdf->setXY(100, 183);
			$pdf->Cell(32, 6, $total_materias, 0, 0, 'C');
			$pdf->setXY(141, 188);
			$pdf->Cell(16, 6, $minima_aprobatoria, 0, 0, 'C');
			$pdf->setXY(49, 193);
			//$pdf->Cell(50, 6, '24 DE JULIO DE 2018', 0, 0, 'C');
			$pdf->Cell(50, 6, $this -> obtenerFechaEnLetra($fecha), 0, 0, 'C');

			// Texto de firmas
			$pdf->SetFont('Times', '', 8);
			$pdf->SetXY(13,210);
			$pdf->Cell(70, 6, utf8_decode('DRA. SILVIA MACÍAS SALINAS'), 0, 1,'C');
			$pdf->setXY(13,213);
			$pdf->Cell(70, 6, utf8_decode('DIRECTORA ACADÉMICA'), 0, 1,'C');
    	$pdf->SetDrawColor(0,0,0);
    	$pdf->setLineWidth(0.2);
    	$pdf->line(15, 241, 79, 241);

      $pdf->SetFont('Times', '', 7);
			$pdf->SetXY(88,210);
			$pdf->Cell(100, 6, utf8_decode('DIRECCIÓN GENERAL DE ACREDITACIÓN, INCORPORACIÓN Y REVALIDACIÓN'), 0, 1,'C');
			$pdf->setXY(88,213);
			$pdf->Cell(95, 6, utf8_decode('SECRETARÍA DE EDUCACIÓN PÚBLICA'), 0, 1,'C');
    	$pdf->line(98, 241, 173, 241);

   //  	// Condicion en caso de que no se llene el espacio en blanco
   //  	// para dibujar las lineas bajo las calificaciones en caso de ser
   //  	// un certificado parcial

   //  	if($certificado->tipo_certificado == 'PARCIAL'){
	  //   	if(sizeof($semestres) < 5) {
	  //   		switch (sizeof($semestres)) {
	  //   			case 1:break;
	  //   			case 3:break;
	  //   			case 3:break;
	  //   			case 4:break;
	  //   		}
	  //   		// Pagina 1
	  //   		$pdf->line(50, $pdf->getY(), 150, $pdf->getY());
	  //   		$pdf->line(150, $pdf->getY(), 185, 276);
	  //   		$pdf->line(50, $pdf->getY(), 185, 276);
			// 		// Pagina 2
	  //   		// $pdf->line(x1, y1, x2, y2);
	  //   		// $pdf->line(x1, y1, x2, y2);
	  //   		// $pdf->line(x1, y1, x2, y2);
	  //   	}else{
	  //   		switch (sizeof($semestres)) {
	  //   			case 6:break;
	  //   			case 7:break;
	  //   			case 8:break;
	  //   			case 9:break;
	  //   		}
	  //   		// Pagina 2
	  //   		// $pdf->line(x1, y1, x2, y2);
	  //   		// $pdf->line(x1, y1, x2, y2);
	  //   		// $pdf->line(x1, y1, x2, y2);
	  //   	}
	  //   }

    	$pdf->setTitle('Certificado de estudios totales - ' . "$datos_estudiante->nombre $datos_estudiante->apaterno $datos_estudiante->amaterno" , true);
    	$pdf->Output('I', 'Certificado de estudios totales - ' . "$datos_estudiante->nombre $datos_estudiante->apaterno $datos_estudiante->amaterno", true);

    	exit; // Indispensable para que funcione el PDF
    }


    /**
     * Descarga de pdf para certificado parcial.
     *
     * @author Er Leví Medina Rodríguez
     * @return pdf
     */
    public function calificaciones($tipo) {
      // PREPARACIÓN DE INFORMACIÓN
      //dd($clase);
      // GENERACIÓN DEL DOCUMENTO
      $pdf = new Fpdf('P','mm','Letter');
      // dd(\Session::get('grupos_print'));
      foreach (\Session::get('grupos_print') as $grupo) {
        if($grupo['print']){
          $clase = Clase::getDatosClase($grupo['clase_id']);
          $oportunidad_acta = \Session::get('oportunidad_id');
          $grupo = Grupo::getAlumosGrupo($grupo['clase_id'],$oportunidad_acta);

          $pdf = $this->getActasExamen($pdf,$clase,$grupo,$tipo,$oportunidad_acta);
        }
      }


      $pdf->setTitle('Acta de examen ordinario ' . $clase -> asignatura, true);
      $pdf->Output('I', 'Acta de examen ordinario ' . $clase -> asignatura, true);

      exit; // Indispensable para que funcione el PDF
    }

    function obtenerFechaEnLetra($fecha){
	    $num = date("j", strtotime($fecha));
	    $ano = date("Y", strtotime($fecha));
	    $mes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
	    $mes = $mes[(date('m', strtotime($fecha))*1)-1];
	    return $num.' DE '.$mes.' DE '.$ano;
		}

		function letraCapital($cadena) {
			$palabras = explode(' ', $cadena);
			$resultado = [];
      foreach ($palabras as $palabra) {
        $saltar = false;
				$palabra =  mb_strtolower($palabra,'UTF-8');
				// Excepciones
        if($palabra == 'de') {$resultado[] = $palabra;$saltar=true;}
				if($palabra == 'en') {$resultado[] = $palabra;$saltar=true;}
				if($palabra == 'a') {$resultado[] = $palabra;$saltar=true;}
        if($palabra == 'y') {$resultado[] = $palabra;$saltar=true;}
        if($palabra == 'la') {$resultado[] = $palabra;$saltar=true;}
        if($palabra == 'del') {$resultado[] = $palabra;$saltar=true;}
        if($palabra == 'el') {$resultado[] = $palabra;$saltar=true;}
				if($palabra == 'i') {$resultado[] = strtoupper($palabra);$saltar=true;}
				if($palabra == 'ii') {$resultado[] = strtoupper($palabra);$saltar=true;}
				if($palabra == 'iii') {$resultado[] = strtoupper($palabra);$saltar=true;}
				if($palabra == 'iv') {$resultado[] = strtoupper($palabra);$saltar=true;}
				if($palabra == 'v') {$resultado[] = strtoupper($palabra);$saltar=true;}
				if($palabra == 'vi') {$resultado[] = strtoupper($palabra);$saltar=true;}
				if($palabra == 'vii') {$resultado[] = strtoupper($palabra);$saltar=true;}
				if($palabra == 'viii') {$resultado[] = strtoupper($palabra);$saltar=true;}
				if($palabra == 'ix') {$resultado[] = strtoupper($palabra);$saltar=true;}
				if($palabra == 'x') {$resultado[] = strtoupper($palabra);$saltar=true;}

        if(!$saltar)
				  $resultado[] = ucwords($palabra);
			}
			return utf8_decode(implode(' ', $resultado));
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
       default :return 'N/A'; break;
      }
    }

    function getGradoLetra($numero){
      switch ($numero) {
        case 1:return 'PRIMERO'; break;
        case 2:return 'SEGUNDO'; break;
        case 3:return 'TERCERO'; break;
        case 4:return 'CUARTO'; break;
        case 5:return 'QUINTO'; break;
        case 6:return 'SEXTO'; break;
        case 7:return 'SÉPTIMO'; break;
        case 8:return 'OCTAVO'; break;
        case 9:return 'NOVENO'; break;
        case 10:return 'DÉCIMO'; break;
       default :return 'N/A'; break;
      }
    }

     private static function cmp($a, $b)
    {
        return strcmp($a -> clave, $b -> clave);
    }

     private static function cmpNombre($a, $b)
    {
        return strcmp($a -> nombre, $b -> nombre);
    }

    function getModalidad($modalidad,$grado){
      if($grado<10)
        $grado = '0' . $grado;
      switch ($modalidad) {
        case 1:return 'SA' . $grado . 'A'; break;
        case 2:return 'SE' . $grado . 'A'; break;
      }
    }

    function getActasExamen($pdf,$clase,$grupo,$tipo,$oportunidad_acta){
      // dd($grupo);

      $pdf->AddPage();
      $pdf->SetFont('Times', 'B', 25);

      //Título
      $pdf->setXY(15, 15); 
      $pdf->Cell(185, 8, utf8_decode('UNIVERSIDAD  DEL CENTRO DEL BAJÍO'),0,0,'C');

      //subtítulo
      $pdf->Ln();
      $pdf->SetFont('Times', 'B', 12);
      switch ($oportunidad_acta) {
        case null:$pdf->Cell(185, 8, 'ACTA DE CALIFICACIONES',0,0,'C');break;
        case 1:$pdf->Cell(185, 8, 'ACTA DE EXAMEN ORDINARIO',0,0,'C');break;
        case 2:$pdf->Cell(185, 8, 'ACTA DE EXAMEN EXTRAORDINARIO',0,0,'C');break;
        case 3:$pdf->Cell(185, 8, 'ACTA DE EXAMEN ESPECIAL',0,0,'C');break;
      }
      // $pdf->Cell(185, 8, 'ACTA DE EXAMEN ORDINARIO',0,0,'C');

      //Encabezado
      $pdf->Ln();
      $pdf->SetFont('Times', '', 8);
      $pdf->Cell(188, 8, $clase -> plan_especialidad,0,0,'R');
      $pdf->Ln();
      $pdf->Cell(30, 8, 'ESPECIALIDAD:','LTR',0,'R');
      $pdf->Cell(2, 8, '',0,0);
      $pdf->Cell(103, 8, utf8_decode(' ' . strtoupper($clase -> nivel_academico) . ' EN ' . strtoupper($clase -> especialidad)),'LTR',0,'L');
      $pdf->Cell(2, 8, '',0,0);
      $pdf->Cell(20, 8, utf8_decode('CLAVE:'),'LTR',0,'R');
      $pdf->Cell(2, 8, '',0,0);
      $pdf->Cell(29, 8, utf8_decode(' ' . strtoupper($clase -> codigo)),'LTR',0,'L');

      $pdf->Ln(5.5);
      $pdf->Cell(30, 8, 'ASIGNATURAS:','LR',0,'R');
      $pdf->Cell(2, 8, '',0,0);
      $pdf->Cell(103, 8, utf8_decode(' ' . mb_strtoupper($clase -> asignatura)),'LR',0,'L');
      $pdf->Cell(2, 8, '',0,0);
      $pdf->Cell(20, 8, utf8_decode('SERIACIÓN:'),'LR',0,'R');
      $pdf->Cell(2, 8, '',0,0);
      $pdf->Cell(29, 8, ' ' . Clase::getSerializacion( $clase -> reticula_id ),'LR',0,'L');

      $pdf->Ln(5.5);
      $pdf->Cell(30, 8, 'GRADO:','LR',0,'R');
      $pdf->Cell(2, 8, '',0,0);
      $pdf->Cell(49, 8, utf8_decode(' ' . strtoupper($this->getGradoLetra($clase -> periodo_reticula))),'L',0,'L');
      $pdf->Cell(54, 8, $clase -> clase,'R',0,'R');
      $pdf->Cell(2, 8, '',0,0);
      $pdf->Cell(20, 8, utf8_decode('PERIODO:'),'LR',0,'R');
      $pdf->Cell(2, 8, '',0,0);
      $pdf->Cell(29, 8, ' ' . $clase -> periodo,'LR',0,'L');

      $pdf->Ln(5.5);
      $pdf->Cell(30, 8, utf8_decode('CRÉDITOS:'),'LBR',0,'R');
      $pdf->Cell(2, 8, '',0,0);
      $pdf->Cell(49, 8, utf8_decode(' ' . strtoupper($this->getNumeroLetra($clase -> creditos))),'LB',0,'L');
      $pdf->Cell(54, 8, $clase -> turno,'BR',0,'R');
      $pdf->Cell(2, 8, '',0,0);
      $pdf->Cell(20, 8, utf8_decode('FECHA:'),'LBR',0,'R');
      $pdf->Cell(2, 8, '',0,0);
      // $pdf->Cell(29, 8, $clase -> fecha_inicio,'LRB',0,'L');
      $pdf->Cell(29, 8, ' ' . \Session::get('date_acta'),'LRB',0,'L');

      //Tabla de alumnos
      $pdf->Ln();
      $pdf->Ln(3);
      $pdf->SetFont('Times', 'B', 8);
      $pdf->Cell(10, 8, utf8_decode('No:'),1,0,'C');
      $pdf->Cell(20, 8, utf8_decode('MATRÍCULA'),1,0,'C');
      $pdf->Cell(83, 8, utf8_decode('ESTUDIANTE'),1,0,'C');
      $pdf->Cell(21, 8, utf8_decode('CAL NÚMERO'),1,0,'C');
      $pdf->Cell(21, 8, utf8_decode('CAL LETRA'),1,0,'C');
      $pdf->Cell(33, 8, utf8_decode('OBSERVACIÓN'),1,0,'C');
      $pdf->Ln(3);

      $fill = true;
      $pdf -> SetFillColor(245,245,245);
      $grupo = (array) $grupo;
      usort($grupo, array('App\Http\Controllers\Admin\PDFController','cmpNombre'));
      $grupo = $grupo[0];
      usort($grupo, array('App\Http\Controllers\Admin\PDFController','cmpNombre'));
      foreach ($grupo as $key => $alumno) {
        if($alumno -> adeudo != null && $tipo == 2)
          $pdf->SetTextColor(255,1,0);
        
        $fill = !$fill;
        $pdf->Ln();
        $pdf->SetFont('Times', '', 8);
        $pdf->Cell(10, 4, $key + 1,1,0,'C',$fill);
        $pdf->Cell(20, 4, $alumno -> matricula,1,0,'C',$fill);
        $pdf->Cell(83, 4, utf8_decode($alumno -> nombre),1,0,'L',$fill);
        $kardex = Kardex::getCalificacionAlumno($clase -> asignatura_id,$alumno -> estudiante_id);
        if(!$alumno -> calificacion)
          $alumno -> calificacion =  ($kardex)? $kardex -> calificacion : '';
        if($alumno -> calificacion <= 5)
          $pdf->SetTextColor(255,1,0);
        $pdf->Cell(21, 4, ($tipo == 1)?$alumno -> calificacion : '',1,0,'C',$fill);
        $pdf->Cell(21, 4, ($alumno -> calificacion != '' && $tipo == 1)? $this -> getNumeroLetra($alumno -> calificacion) : '',1,0,'C',$fill);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(33, 4, '',1,0,'C',$fill);
      }
      $y = $pdf->getY() + 8;

      //Firmas
      $pdf->setY($y + 9);
      $pdf->SetFont('Times', '', 9);
      $pdf->Cell(83, 20, utf8_decode($clase -> nombre . ' ' . $clase -> apaterno . ' ' .$clase -> amaterno),0,0,'L');
      $pdf->Cell(22, 8, '',0,0,'L');
      $pdf->Cell(83, 20, utf8_decode('LIC. MA. JAQUELINE SÁNCHEZ GONZÁLEZ'),0,0,'L');
      $pdf->Ln(10);
      $pdf->Cell(83, 8, utf8_decode('CATEDRÁTICO'),0,0,'L');
      $pdf->Cell(22, 8, '',0,0,'L');
      $pdf->Cell(83, 8, utf8_decode('SERVICIOS ESCOLARES'),0,0,'L');
      $pdf->setLineWidth(0.2);
      $pdf->line(10, $y, 104, $y);
      $pdf->line(10, $y, 10, $y + 25);
      $pdf->line(104, $y, 104, $y + 25);
      $pdf->line(10, $y + 25, 104, $y + 25);
      $pdf->line(115, $y, 198, $y);
      $pdf->line(115, $y, 115, $y + 25);
      $pdf->line(198, $y, 198, $y + 25);
      $pdf->line(115, $y + 25, 198, $y + 25);

      return $pdf;
    }
}
