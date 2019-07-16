<?php

namespace App\Services\Excel;

use Illuminate\Database\Eloquent\Model;
use Rap2hpoutre\FastExcel\FastExcel;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
use App\Models\ModalidadEstudiante;
use App\Models\ModalidadEspecialidad;
use App\Models\NivelAcademico;
use App\Models\TipoPlanEspecialidad;
use App\Models\Especialidad;
use App\Models\Oportunidad;
use App\Models\TipoExamen;
use App\Models\Titulo;
use App\Models\EstadoEstudiante;
use App\Models\Asignatura;
use App\Models\Periodo;
use App\Models\Docente;
use App\Models\DatoGeneral;
use App\Models\Usuario;
use App\Models\Localidad;
use App\Models\Nacionalidad;
use App\Models\EstadoCivil;

use App\Models\MedioEnterado;
use App\Models\Clase;
use App\Models\Grupo;
use App\Models\Reticula;
use App\Models\PlanEspecialidad;
use App\Models\Estudiante;
use App\Models\Kardex;
use App\Models\Test_adeudo;
use App\Models\pagoEstudiante;
class FastExcelImporter extends Importer
{
    public function import(string $model, $file)
    {
        switch($model)
        {
            case 'titulos':                     return $this->importTitulos($file);

            case 'tiposPlanesEspecialidades':   return $this->importTiposPlanesEspecialidades($file);

            case 'tiposExamenes':               return $this->importTiposExamenes($file);

            case 'oportunidades':               return $this->importOportunidades($file);

            case 'nivelesAcademicos':           return $this->importNivelesAcademicos($file);

            case 'modalidadesEstudiantes':      return $this->importModalidadesEstudiantes($file);

            case 'estadosEstudiantes':          return $this->importEstadosEstudiantes($file);

            case 'asignaturas':                 return $this->importAsignaturas($file);

            case 'especialidades':              return $this->importEspecialidades($file);

            case 'periodos':                    return $this->importPeriodos($file);

            case 'docentes':                    return $this->importDocentes($file);

            case 'estadosCiviles':              return $this->importEstadosCiviles($file);

            case 'mediosEnterados':             return $this->importMediosEnterados($file);

            case 'planesEspecialidades':        return $this->importPlanesEspecialidades($file);
            
            case 'reticulas':                   return $this->importReticulas($file);

            case 'clases':                   return $this->importClases($file);

            case 'grupos':                   return $this->importGrupos($file);

            case 'kardex':                   return $this->importKardex($file);

            case 'estudiantes':                   return $this->importEstudiantes($file);

            case 'temp_adeudos':                    return $this->importAdeudos($file);

            case 'pagos_estudiantes':                    return $this->pagos_estudiantes($file);
        }
    }
    private function importMediosEnterados($file)
    {
        return $this->importManyFromFile($file, MedioEnterado::class, ['medio_enterado', new OptionalField('descripcion')]);
    }
    private function importEstudiantes($file)
    {
        return $this->importManyFromFile($file,  Estudiante::class, [
            'matricula',
            'grupo',
            new OptionalField('semestre'),
            new OptionalField('semestre_disp'),
            new OptionalField('otros'),
            new ForeignField('especialidad_id', 'especialidad', Especialidad::class, true),
            new ForeignField('estado_estudiante_id', 'estado_estudiante', EstadoEstudiante::class, true),
            new ForeignField('modalidad_id', 'modalidad_estudiante', ModalidadEstudiante::class, true),
            new OptionalField('fecha'),
            new OptionalField('folio'),
            new OptionalField('expediente'),
            new ForeignField('medio_enterado_id', 'medio_enterado', MedioEnterado::class, true),
            new ForeignField('periodo_id', 'periodo', Periodo::class, true),
            new ForeignField('plan_especialidad_id', 'plan_especialidad', PlanEspecialidad::class, true),
        ], [
            'dato_general_id' => [
                'class' => DatoGeneral::class,
                'fields' => [
                    'curp',
                    'nombre',
                    'apaterno',
                    'amaterno',
                    'fecha_nacimiento',
                    'sexo',
                    new OptionalField('calle_numero'),
                    new OptionalField('colonia'),
                    new OptionalField('codigo_postal'),
                    new OptionalField('telefono_casa'),
                    new OptionalField('telefono_personal'),
                    new OptionalField('fecha_registro'),
                    new ForeignField('localidad_id', 'localidad', Localidad::class, true),
                    new ForeignField('nacionalidad_id', 'nacionalidad', Nacionalidad::class, true),
                    new ForeignField('estado_civil_id', 'estado_civil', EstadoCivil::class, true),
                ]
            ],
            'usuario_id' => [
                'class' => Usuario::class,
                'fields' => [
                    'email',
                    'password',
                    new OptionalField('rol_id', 1)
                ]
            ],
        ]);
    }

    private function importClases($file)
    {
        return $this->importManyFromFile($file, Clase::class, [
            'turno',
            'clase',
            new ForeignField('asignatura_id', 'asignatura', Asignatura::class, true),
            new ForeignField('docente_id', 'codigo', Docente::class, true),
            new ForeignField('especialidad_id', 'especialidad', Especialidad::class, true),
            new ForeignField('periodo_id', 'periodo', Periodo::class, true),
        ]);
    }
    private function importGrupos($file)
    {
        return $this->importManyFromFile($file, Grupo::class, [
            new ForeignField('clase_id', 'clase', Clase::class, true),
            new ForeignField('estudiante_id', 'matricula', Estudiante::class, true),
            new ForeignField('oportunidad_id', 'oportunidad', Oportunidad::class, true),
        ]);
    }
    private function importKardex($file)
    {
        return $this->importManyFromFile($file, Kardex::class, [
            'estudiante_id',
            'asignatura_id',
            'oportunidad_id',
            'semestre',
            'periodo_id',
            new OptionalField('grupo_id'),
            'calificacion',
        ]);
    }

    private function importPlanesEspecialidades($file)
    {
        return $this->importManyFromFile($file, PlanEspecialidad::class, [
            'plan_especialidad', 
            'periodos',
            new ForeignField('especialidad_id', 'especialidad', Especialidad::class, true),
            new ForeignField('coordinador_id', 'codigo', Docente::class, true),
            new OptionalField('descripcion')
        ]);
    }
    private function importReticulas($file)
    {
        return $this->importManyFromFile($file, Reticula::class, [
            new ForeignField('asignatura_id', 'asignatura', Asignatura::class, true),
            new ForeignField('plan_especialidad_id', 'plan_especialidad', PlanEspecialidad::class, true),
            'periodo_reticula'
        ]);
    }



    private function importTitulos($file)
    {
        return $this->importManyFromFile($file, Titulo::class, ['titulo', new OptionalField('descripcion')]);
    }

    private function importTiposPlanesEspecialidades($file) 
    {
        return $this->importManyFromFile($file, TipoPlanEspecialidad::class, ['tipo_plan_especialidad', new OptionalField('descripcion')]);
    }

    private function importEstadosCiviles($file)
    {
        return $this->importManyFromFile($file, EstadoCivil::class, ['estado_civil']);
    }

    private function importTiposExamenes($file)
    {
        return $this->importManyFromFile($file, TipoExamen::class, ['tipo_examen', new OptionalField('descripcion')]);
    }

    private function importOportunidades($file)
    {
        return $this->importManyFromFile($file, Oportunidad::class, ['oportunidad', new OptionalField('descripcion')]);
    }

    private function importNivelesAcademicos($file)
    {
        return $this->importManyFromFile($file, NivelAcademico::class,['nivel_academico', new OptionalField('descripcion')]);
    }

    private function importModalidadesEstudiantes($file)
    {
        return $this->importManyFromFile($file, ModalidadEstudiante::class, ['modalidad_estudiante',new OptionalField('descripcion')]);
    }

    private function importEstadosEstudiantes($file)
    {
        return $this->importManyFromFile($file, EstadoEstudiante::class, ['estado_estudiante', new OptionalField('descripcion')]);
    }

    private function importAsignaturas($file) 
    {
        return $this->importManyFromFile($file,  Asignatura::class, ['codigo', 'asignatura', 'creditos']);
    }

    private function importPeriodos($file) 
    {
        return $this->importManyFromFile($file, Periodo::class, [
            'anio', 
            'periodo', 
            'fecha_reconocimiento', 
            'reconocimiento_oficial', 
            'dges',
            new OptionalField('jefe_control'),
            new OptionalField('director')
        ]);
    }

    private function importAdeudos($file) 
    {
        Test_adeudo::truncate();
        return $this->importManyFromFile($file, Test_adeudo::class, [
            'matricula',
        ]);
    }

    private function pagos_estudiantes($file) 
    {
        return $this->importManyFromFile($file, pagoEstudiante::class, [
            'estudiante_id', 
            new OptionalField('recibo_folio'), 
            'fecha_pago', 
            'concepto_id', 
            'cantidad', 
            'mes_inicio', 
            'mes_final', 
            'anio', 
            'hecho_por_id', 
            new OptionalField('catalogo_contabilidad_id'), 
            new OptionalField('banco_id'),
        ]);
    }

    private function importEspecialidades($file)
    {
        return $this->importManyFromFile($file, Especialidad::class, [
            'clave', 
            'especialidad',
            'reconocimiento_oficial',
            'dges',
            'fecha_reconocimiento',
            new OptionalField('descripcion'),
            new ForeignField('modalidad_id', 'modalidad_especialidad', ModalidadEspecialidad::class, true),
            new ForeignField('nivel_academico_id', 'nivel_academico', NivelAcademico::class, true),
            new ForeignField('tipo_plan_especialidad_id', 'tipo_plan_especialidad', TipoPlanEspecialidad::class, true),
        ]);
    }

    private function importDocentes($file)
    {
        return $this->importManyFromFile($file,  Docente::class, [
            'codigo',
            new OptionalField('rfc'),
            new ForeignField('titulo_id', 'titulo', Titulo::class, true)
        ], [
            'dato_general_id' => [
                'class' => DatoGeneral::class,
                'fields' => [
                    'curp',
                    'nombre',
                    'apaterno',
                    'amaterno',
                    'fecha_nacimiento',
                    'sexo',
                    new OptionalField('calle_numero'),
                    new OptionalField('colonia'),
                    new OptionalField('codigo_postal'),
                    new OptionalField('telefono_casa'),
                    new OptionalField('telefono_personal'),
                    new OptionalField('fecha_registro'),
                    new ForeignField('localidad_id', 'localidad', Localidad::class, true),
                    new ForeignField('nacionalidad_id', 'nacionalidad', Nacionalidad::class, true),
                    new ForeignField('estado_civil_id', 'estado_civil', EstadoCivil::class, true),
                ]
            ],
            'usuario_id' => [
                'class' => Usuario::class,
                'fields' => [
                    'email',
                    'password',
                    new OptionalField('rol_id', 1)
                ]
            ],
        ]);
    }

    /**
     * Helper functions to abstract generic functionality.
     */
    

    private function hasRequiredHeaders($file, array $fields) 
    {
        $result = true;

        $reader = ReaderFactory::create(Type::XLSX);
        $reader->open($file);

        $requiredColumns = array_map(function($item) {
            return is_string($item) ?  $item : $item->getKey();
        }, $fields);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $headers) {
                $result = sizeof(array_diff($requiredColumns, $headers)) === 0;
                break;
            }
            break;
        }

        $reader->close();

        return $result;
    }

    private function importManyFromFile($file, $class, array $fields , array $foreignFields = [])
    {
        $cache = $errors = [];
        $row = $imported = 0;

        \DB::transaction(function () use($file, $fields, $foreignFields, $class, &$row, &$imported, &$errors, &$cache) {
            (new FastExcel)->import($file, function ($line) use($fields, $foreignFields, $class, &$row, &$imported, &$errors, &$cache) {
                $row += 1;
                
                # Ignore empty rows
                if(!array_filter($line)) return;
                
                try { 
                    # Transform the row into a dictionary
                    $data = $this->getDataFromRow($line, $fields, $cache);
                    // dd($data);

                    # Create a partial model with the available data
                    $model = $class::make($data);
                    // dd($model);
                    
                    # Create and associate all the required foreign records to the model
                    foreach($foreignFields as $foreignKey => $foreignData) {
                        # Get the fields and the Eloquent Model of the foreign table
                        $foreignValues                  =   $foreignData['fields'];
                        $foreignClass                   =   $foreignData['class'];
                        
                        # Transform the foreign row into a dictionary and save it in the database
                        $foreignData                    =   $this->getDataFromRow($line, $foreignValues, $cache);
                        $foreignRow                     =   $foreignClass::create($foreignData);

                        # Store the created record in the array to keep track of it
                        $foreignFields[$foreignKey]     =   $foreignRow;
                        # Assign the record's id to the model's foreign key
                        $model[$foreignKey]             =   $foreignRow->id;
                    }

                    # Save the complete model in the database
                    $model->save();

                    $imported += 1;
                }
                catch(\Illuminate\Database\QueryException $e) {
                    # If something goes wrong, delete any previously saved foreign records to ensure consistency
                    foreach($foreignFields as $foreignColumn => $model){
                        if($model instanceof Model) $model->delete();
                    }

                    array_push($errors, [
                        'row'       => $row + 1,
                        'message'   => $this->getUserMessage($e->getCode()),
                        'sql'       => $e->getMessage()
                    ]);
                }
                catch(RequiredFieldException $e) {
                    # If something goes wrong, delete any previously saved foreign records to ensure consistency
                    foreach($foreignFields as $foreignColumn => $model){
                        if($model instanceof Model) $model->delete();
                    }

                    array_push($errors, [
                        'row'       => $row + 1,
                        'message'   => $this->getUserMessage($e->getCode()),
                        'sql'       => $e->getMessage()
                    ]);
                }
            });    
        });
        
        return $this->getStatus($errors, $imported);
    }

    private function importFromFile($file, $class, array $fields)
    {
        $cache = $errors = [];
        $row = $imported = 0;

        /*
        if(! $this->hasRequiredHeaders($file, $fields)) {
            $errors = array([ 'row' => 1, 'message' => 'Formato de archivo inválido' ]);

            return $this->getStatus($errors, $imported);
        }*/

        \DB::transaction(function () use($file, $fields, $class, &$row, &$imported, &$errors, &$cache) {
            (new FastExcel)->import($file, function ($line) use($fields, $class, &$row, &$imported, &$errors, &$cache) {
                $row += 1;
                
                # Ignore empty rows
                if(!array_filter($line)) return;
    
                # Transform the row into a dictionary
                $data = $this->getDataFromRow($line, $fields, $cache);
                
                try { 
                    # Save the row in the database
                    $class::create($data); 
                    $imported += 1;
                }
                catch(\Illuminate\Database\QueryException $e){
                    array_push($errors, [
                        'row' => $row + 1,
                        'message' => $this->getUserMessage($e->getCode()),
                        'sql' => $e->getMessage()
                    ]);
                }
            });    
        });
        
        return $this->getStatus($errors, $imported);
    }
}