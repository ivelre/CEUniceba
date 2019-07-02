<?php

namespace App\Services\Excel;

use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\ModalidadEstudiante;
use App\Models\EstadoCivil;
use App\Models\EstadoEstudiante;
use App\Models\Asignatura;
use App\Models\NivelAcademico;
use App\Models\TipoPlanEspecialidad;
use App\Models\Especialidad;
use App\Models\Oportunidad;
use App\Models\TipoExamen;
use App\Models\Titulo;
use App\Models\Estudiante;
use App\Models\Docente;
use App\Models\Periodo;
use App\Models\MedioEnterado;
use App\Models\Reticula;
use App\Models\PlanEspecialidad;
use App\Models\Grupo;
use App\Models\Kardex;
use App\Models\Clase;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class FastExcelExporter
{
    public function export(string $model)
    {
        switch($model){
            case 'titulos':                     return $this->exportTitulos();

            case 'tiposPlanesEspecialidades':   return $this->exportTiposPlanesEspecialidades();

            case 'tiposExamenes':               return $this->exportTiposExamenes();

            case 'oportunidades':               return $this->exportOportunidades();

            case 'nivelesAcademicos':           return $this->exportNivelesAcademicos();

            case 'modalidadesEstudiantes':      return $this->exportModalidadesEstudiantes();

            case 'estadosEstudiantes':          return $this->exportEstadosEstudiantes();

            case 'asignaturas':                 return $this->exportAsignaturas();

            case 'especialidades':              return $this->exportEspecialidades();

            case 'periodos':                    return $this->exportPeriodos();

            case 'estadosCiviles':              return $this->exportEstadosCiviles();

            case 'mediosEnterados':             return $this->exportMediosEnterados();

            case 'planesEspecialidades':        return $this->exportPlanesEspecialidades();

            case 'reticulas':                   return $this->exportReticulas();
            
            case 'grupos':                      return $this->exportGrupos();

            case 'clases':                      return $this->exportClases();

            case 'kardex':                      return $this->exportKardex();

            case 'estudiantes':                 return $this->exportEstudiantes();

            case 'docentes':                    return $this->exportDocentes();
        }
    }

    private function exportTitulos(){
        return (new FastExcel(Titulo::all()))->download('titulos.xlsx');
    }

    private function exportTiposPlanesEspecialidades(){
        return (new FastExcel(TipoPlanEspecialidad::all()))->download('tiposPlanesEspecialidades.xlsx');
    }

    private function exportTiposExamenes(){
        return (new FastExcel(TipoExamen::all()))->download('tiposExamenes.xlsx');
    }

    private function exportOportunidades(){
        return (new FastExcel(Oportunidad::all()))->download('oportunidades.xlsx');
    }

    private function exportNivelesAcademicos(){
        return (new FastExcel(NivelAcademico::all()))->download('nivelesAcademicos.xlsx');
    }

    private function exportModalidadesEstudiantes(){
        return (new FastExcel(ModalidadEstudiante::all()))->download('modalidadesEstudiantes.xlsx');
    }

    private function exportEstadosEstudiantes(){
        return (new FastExcel(EstadoEstudiante::all()))->download('estadosEstudiantes.xlsx');
    }

    private function exportAsignaturas(){
        return (new FastExcel(Asignatura::all()))->download('asignaturas.xlsx');
    }

    private function exportEspecialidades(){
        return (new FastExcel(Especialidad::all()))->download('especialidades.xlsx');
    }

    private function exportPeriodos(){
        return (new FastExcel(Periodo::all()))->download('periodos.xlsx');
    }

    private function exportEstadosCiviles(){
        return (new FastExcel(EstadoCivil::all()))->download('estadosCiviles.xlsx');
    }

    private function exportMediosEnterados(){
        return (new FastExcel(MedioEnterado::all()))->download('mediosEnterados.xlsx');
    }

    private function exportPlanesEspecialidades(){
        return (new FastExcel(PlanEspecialidad::all()))->download('planesEspecialidades.xlsx');
    }

    private function exportReticulas(){
        return (new FastExcel(Reticula::all()))->download('reticulas.xlsx');
    }

    private function exportGrupos(){
        #return (new FastExcel(Grupo::all()))->download('grupos.xlsx');
        return (new ChunkedFastExcel(Grupo::query(), 5000))->download('grupos.xlsx');    
    }

    private function exportClases(){
        #return (new FastExcel(Clase::all()))->download('clases.xlsx');
        return (new ChunkedFastExcel(Clase::query(), 5000))->download('clases.xlsx');    
    }

    private function exportKardex(){
        #return (new FastExcel(Kardex::get()))->download('kardex.xlsx');
        return (new ChunkedFastExcel(Kardex::query(), 20000))->download('kardex.xlsx');    
    }

    private function exportDocentes(){
        $query = \DB::table('docentes')->select(
                    'docentes.id as id',
                    'codigo',
                    'rfc',
                    'titulo_id',
                    'curp',
                    'nombre',
                    'apaterno',
                    'amaterno',
                    'fecha_nacimiento',
                    'calle_numero',
                    'colonia',
                    'codigo_postal',
                    'localidad_id',
                    'telefono_casa',
                    'telefono_personal',
                    'estado_civil_id',
                    'sexo',
                    'fecha_registro',
                    'nacionalidad_id',
                    'usuarios.email as email',
                    'password'
                )
                ->join('usuarios','docentes.usuario_id','=','usuarios.id')
                ->join('datos_generales', 'docentes.dato_general_id', '=', 'datos_generales.id')
                ->orderBy('docentes.id');
        return (new FastExcel($query->get()))->download('docentes.xlsx');
    }

    private function exportEstudiantes(){
        $query = \DB::table('estudiantes')->select(
                    'estudiantes.id as id',
                    'matricula',
                    'curp',
                    'nombre',
                    'apaterno',
                    'amaterno',
                    'fecha_nacimiento',
                    'calle_numero',
                    'colonia',
                    'codigo_postal',
                    'localidad_id',
                    'telefono_casa',
                    'telefono_personal',
                    'estado_civil_id',
                    'sexo',
                    'fecha_registro',
                    'nacionalidad_id',
                    'usuarios.email as email',
                    'password',
                    'especialidad_id',
                    'semestre',
                    'semestre_disp',
                    'grupo',
                    'modalidad_id',
                    'medio_enterado_id',
                    'periodo_id',
                    'otros',
                    'estado_estudiante_id',
                    'plan_especialidad_id'
                )
                ->join('usuarios','estudiantes.usuario_id','=','usuarios.id')
                ->join('datos_generales', 'estudiantes.dato_general_id', '=', 'datos_generales.id')
                ->orderBy('estudiantes.id');

        return (new ChunkedFastExcel($query, 4000))->download('estudiantes.xlsx');
        /*
        $writer = WriterFactory::create(Type::XLSX);
        $writer->openToBrowser('titulos.xlsx');
        $query->chunk(7000, function($users) use($writer){
            foreach($users as $user) {
                $writer->addRow((array)$user);
            }
        });
        $writer->close();
        
        return '';
        */
    }
}