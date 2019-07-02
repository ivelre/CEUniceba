<?php

namespace App\Http\Controllers\Admin;

use App\Models\Estudiante;
use App\Models\Asignatura;
use App\Models\Periodo;
use App\Models\FechaExamen;
use App\Models\PlanEspecialidad;
use App\Models\DataTable;
use App\Models\EstadoEstudiante;
use App\Models\Titulo;
use App\Models\TipoExamen;
use App\Models\Oportunidad;
use App\Models\NivelAcademico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class DataTableController extends Controller
{
    /**
     * Lista de estudiantes registrados.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return Yajra\Datatables\Datatables  - Estudiantes (Datatables)
     */
    public function estudiantes(){
    	$estudiantes = DataTable::estudiantes();
    	return Datatables::of($estudiantes)->make(true);
    }

    /**
     * Lista de asignaturas registradas.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return Yajra\Datatables\Datatables  - Asignaturas (Datatables)
     */
    public function asignaturas(){
    	$asignaturas = Asignatura::orderBy('id','desc')->get();
    	return Datatables::of($asignaturas)->make(true);	
    }

    /**
     * Lista de periodos registrados.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return Yajra\Datatables\Datatables  - Periodos (Datatables)
     */
    public function periodos(){
    	$periodos = Periodo::orderBy('id','desc')->get();
    	return Datatables::of($periodos)->make(true);
    }

    /**
     * Lista de fechas de exámenes de un periodo especifíco.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request     $request    - Periodo de los exámenes.
     * @return Yajra\Datatables\Datatables              - Fecha de Exámenes
     */
    public function fechas_examenes(Request $request){
        $fechas_examenes = DataTable::fechas_examenes($request->periodo_id);
        return Datatables::of($fechas_examenes)->make(true);    
    }

    /**
     * Lista de especialidades registradas.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return Yajra\Datatables\Datatables  - Especialidades (Datatables)
     */
    public function especialidades(){
        $especialidades = DataTable::especialidades();
        return Datatables::of($especialidades)->make(true);
    }

    /**
     * Lista de planes de estudio de una especialidad específica.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request     $request    - Especialidad.
     * @return Yajra\Datatables\Datatables              - Planes de estudio (Datatables)
     */
    public function planes_especialidades(Request $request){
        $planes_especialidad = PlanEspecialidad::where('especialidad_id',$request->especialidad_id)->get();
        return Datatables::of($planes_especialidad)->make(true);
    }

    /**
     * Lista de docentes registrados.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return Yajra\Datatables\Datatables  - Estudiantes (Datatables)
     */
    public function docentes(){
        $docentes = DataTable::docentes();
        foreach ($docentes as $key => $docente) {
            $fecha_nacimiento = new \DateTime($docente->fecha_nacimiento);
            $today = new \DateTime(date("Y-m-d"));
            $edad = $fecha_nacimiento->diff($today);
            $docente->edad = $edad->y;
        }
        return Datatables::of($docentes)->make(true);
    }

    /**
     * Lista de clases registradas.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request     $request->periodo_id        - Período escolar
     * @param  \Illuminate\Http\Request     $request->especialidad_id   - Especialidad
     * @return Yajra\Datatables\Datatables                              - Clases (Datatables)
     */
    public function clases(Request $request){
        $clases = DataTable::clases($request->periodo_id,$request->especialidad_id);
        return Datatables::of($clases)->make(true);
    }

    /**
     * Kardex de un estudiante.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request     $request    - Estudiante
     * @return Yajra\Datatables\Datatables              - Kardex del estudiante (Datatables)
     */
    public function kardex(Request $request){
        $kardex = DataTable::kardex($request->estudiante_id);
        return Datatables::of($kardex)->make(true);
    }

    /**
     * Grupos de una clase específica.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request     $request    - Clase específica
     * @return Yajra\Datatables\Datatables              - Grupo (Datatables)
     */
    public function grupos(Request $request){
        $grupo = DataTable::grupos($request->clase);
        return Datatables::of($grupo)->make(true);
    }

    /**
     * Estados de los estudiantes
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return Yajra\Datatables\Datatables - Estado de los Estudiantes (Datatables)
     */
    public function estados_estudiantes(){
        $estados_estudiantes = EstadoEstudiante::get();
        return Datatables::of($estados_estudiantes)->make(true);
    }

    /**
     * Títulos de los docentes.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return Yajra\Datatables\Datatables - Títulos de los docentes.
     */
    public function titulos_docentes(){
        $titulos = Titulo::get();
        return Datatables::of($titulos)->make(true);
    }

    /**
     * Tipos de examénes
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return Yajra\Datatables\Datatables  - Tipos de eámenes (Datatables)
     */
    public function tipos_examenes(){
        $tipos_examenes = TipoExamen::get();
        return Datatables::of($tipos_examenes)->make(true);
    }    

    /**
     * Oportunidades de las clases.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return Yajra\Datatables\Datatables  - Oportunidades de las clases (Datatables)
     */
    public function oportunidades(){
        $oportunidades = Oportunidad::get();
        return Datatables::of($oportunidades)->make(true);
    } 

    /**
     * Niveles académicos.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return Yajra\Datatables\Datatables  - Niveles académicos (Datatables)
     */
    public function niveles_academicos(){
        $niveles_academicos = NivelAcademico::get();
        return Datatables::of($niveles_academicos)->make(true);
    }
}
