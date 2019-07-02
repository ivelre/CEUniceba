<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use \Illuminate\Http\UploadedFile;
class ExcelImporterTest extends TestCase
{
    use RefreshDatabase;
    private $filePath = __DIR__.'/../files/';

    private function import($file, $model) {
        $user = factory(\App\Models\Usuario::class)->create(['id' => 0]);
        $file = new UploadedFile($this->filePath.$file, true);
        
        $response = $this->withSession(['usuario' => $user])
                        ->post('admin/excel/import?model='.$model, ['excel' => $file]);

        return $response;
    }

    public function testImportTitulos()
    {
        $response = $this->import('titulos.xlsx', 'titulos');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 4
        ]);

        $this->assertDatabaseHas('titulos',['titulo' => 'SIN TITULO']);
        $this->assertDatabaseHas('titulos',['titulo' => 'LICENCIATURA']);
        $this->assertDatabaseHas('titulos',['titulo' => 'MAESTRIA']);
        $this->assertDatabaseHas('titulos',['titulo' => 'DOCTORADO']);
    }

    public function testImportOportunidades()
    {
        $response = $this->import('oportunidades.xlsx', 'oportunidades');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 5
        ]);
        
        $this->assertDatabaseHas('oportunidades',[
            'oportunidad' => 'Normal',
            'oportunidad' => 'Repetición',
            'oportunidad' => 'Especial',
            'oportunidad' => 'Ninguna',
            'oportunidad' => 'N/A',
        ]);
    }

    public function testImportTiposPlanesEspecialidades()
    {
        $response = $this->import('tiposPlanesEspecialidades.xlsx', 'tiposPlanesEspecialidades');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 5
        ]);

        $this->assertDatabaseHas('tipos_planes_especialidades',['tipo_plan_especialidad' => 'Bimestral']);
        $this->assertDatabaseHas('tipos_planes_especialidades',['tipo_plan_especialidad' => 'Trimestral']);
        $this->assertDatabaseHas('tipos_planes_especialidades',['tipo_plan_especialidad' => 'Cuatrimestral']);
        $this->assertDatabaseHas('tipos_planes_especialidades',['tipo_plan_especialidad' => 'Anual']);
    }

    public function testImportEstadosCiviles()
    {
        $response = $this->import('estadosCiviles.xlsx', 'estadosCiviles');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 5
        ]);

        $this->assertDatabaseHas('estados_civiles',['estado_civil' => 'Casado']);
        $this->assertDatabaseHas('estados_civiles',['estado_civil' => 'Divorciado']);
        $this->assertDatabaseHas('estados_civiles',['estado_civil' => 'Otro']);
        $this->assertDatabaseHas('estados_civiles',['estado_civil' => 'Soltero']);
        $this->assertDatabaseHas('estados_civiles',['estado_civil' => 'Viudo']);
    }

    public function testImportNivelesAcademicos()
    {
        $response = $this->import('nivelesAcademicos.xlsx', 'nivelesAcademicos');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 4
        ]);

        $this->assertDatabaseHas('niveles_academicos',['nivel_academico' => 'Licenciatura']);
        $this->assertDatabaseHas('niveles_academicos',['nivel_academico' => 'Maestría']);
        $this->assertDatabaseHas('niveles_academicos',['nivel_academico' => 'Doctorado']);
        $this->assertDatabaseHas('niveles_academicos',['nivel_academico' => 'Tecnico']);
    }

    public function testImportEstadosEstudiantes()
    {
        $response = $this->import('estadosEstudiantes.xlsx', 'estadosEstudiantes');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 5
        ]);
        $this->assertDatabaseHas('estados_estudiantes',['estado_estudiante' => 'Egresado']);
        $this->assertDatabaseHas('estados_estudiantes',['estado_estudiante' => 'Inscrito']);
        $this->assertDatabaseHas('estados_estudiantes',['estado_estudiante' => 'Reinscrito']);
        $this->assertDatabaseHas('estados_estudiantes',['estado_estudiante' => 'Baja definitiva']);
        $this->assertDatabaseHas('estados_estudiantes',['estado_estudiante' => 'Adeudo']);
    }

    public function testImportTiposExamenes()
    {
        $response = $this->import('tiposExamenes.xlsx', 'tiposExamenes');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 4
        ]);

        $this->assertDatabaseHas('tipos_examenes',['tipo_examen' => 'Ordinario']);
        $this->assertDatabaseHas('tipos_examenes',['tipo_examen' => 'Extraordinario']);
        $this->assertDatabaseHas('tipos_examenes',['tipo_examen' => 'Especial']);
        $this->assertDatabaseHas('tipos_examenes',['tipo_examen' => 'Ordinario LC31']);
    }

    public function testImportModalidadesEstudiantes()
    {
        $response = $this->import('modalidadesEstudiantes.xlsx', 'modalidadesEstudiantes');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 8
        ]);

        $this->assertDatabaseHas('modalidades_estudiantes',['modalidad_estudiante' => 'SABATINO']);
        $this->assertDatabaseHas('modalidades_estudiantes',['modalidad_estudiante' => 'MATUTINO']);
        $this->assertDatabaseHas('modalidades_estudiantes',['modalidad_estudiante' => 'MIXTO']);
        $this->assertDatabaseHas('modalidades_estudiantes',['modalidad_estudiante' => 'SABATINO']);
        $this->assertDatabaseHas('modalidades_estudiantes',['modalidad_estudiante' => 'JUEVES']);
        $this->assertDatabaseHas('modalidades_estudiantes',['modalidad_estudiante' => 'VIERNES']);
    }

    public function testImportAsignaturas()
    {
        $response = $this->import('asignaturas.xlsx', 'asignaturas');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 1200
        ]);

        $this->assertDatabaseHas('asignaturas',[
            'codigo' => 'LC30417',
            'asignatura' => 'Costos Históricos',
            'creditos' => 8
        ]);

        $this->assertDatabaseHas('asignaturas',[
            'codigo' => 'MA0309',
            'asignatura' => 'DESARROLLO ORGANIZACIONAL',
            'creditos' => 0
        ]);
    }

    public function testImportPeriodos()
    {
        $response = $this->import('periodos.xlsx', 'periodos');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 49
        ]);

        $this->assertDatabaseHas('periodos',[
            'periodo' => '08/1',
            'reconocimiento_oficial' => 'JULIO-DICIEMBRE 2007',
            'director' => 'LIC. SILVIA MACIAS SALINAS'
        ]);

        $this->assertDatabaseHas('periodos',[
            'anio' => '2000',
            'fecha_reconocimiento' => '1994-08-01',
            'jefe_control' => 'N/A'
        ]);

        $this->assertDatabaseHas('periodos',[
            'periodo' => '95/2',
            'dges' => 'ENERO-JUNIO 1995',
            'jefe_control' => 'C. MA. JAQUELINE SANCHEZ GONZALEZ',
            'director' => 'LIC. LUIS JUAN CARLOS GUEVARA HERNANDEZ'
        ]);
    }

    public function testImportGrupos() {
        factory(\App\Models\Estudiante::class)->create(['matricula' => '123']);
        factory(\App\Models\Estudiante::class)->create(['matricula' => '456']);
        factory(\App\Models\Estudiante::class)->create(['matricula' => '789']);
        factory(\App\Models\Estudiante::class)->create(['matricula' => '999']);
        factory(\App\Models\Estudiante::class)->create(['matricula' => '111']);
        $this->seed('OportunidadesTableSeeder');
        $response = $this->import('grupos.xlsx', 'grupos');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 10,
            'imported' => 40
        ]);
    }

    public function testImportClases() {
        factory(\App\Models\Docente::class)->create(['codigo' => '123']);
        factory(\App\Models\Docente::class)->create(['codigo' => '456']);
        factory(\App\Models\Docente::class)->create(['codigo' => '789']);
        factory(\App\Models\Docente::class)->create(['codigo' => '999']);
        factory(\App\Models\Docente::class)->create(['codigo' => '111']);
        factory(\App\Models\Asignatura::class)->create(['asignatura' => 'Cálculo']);
        factory(\App\Models\Asignatura::class)->create(['asignatura' => 'Física']);
        factory(\App\Models\Asignatura::class)->create(['asignatura' => 'Programación']);
        $this->seed('EspecialidadesTableSeeder');
        $this->seed('PeriodosTableSeeder');
        $response = $this->import('clases.xlsx', 'clases');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 15,
            'imported' => 35
        ]);
    }

    public function testImportKardex() {
        factory(\App\Models\Estudiante::class)->create(['matricula' => '123']);
        factory(\App\Models\Estudiante::class)->create(['matricula' => '456']);
        factory(\App\Models\Estudiante::class)->create(['matricula' => '789']);
        factory(\App\Models\Estudiante::class)->create(['matricula' => '999']);
        factory(\App\Models\Estudiante::class)->create(['matricula' => '111']);
        factory(\App\Models\Asignatura::class)->create(['asignatura' => 'Cálculo']);
        factory(\App\Models\Asignatura::class)->create(['asignatura' => 'Física']);
        factory(\App\Models\Asignatura::class)->create(['asignatura' => 'Programación']);
        $this->seed('OportunidadesTableSeeder');
        $this->seed('PeriodosTableSeeder');
        $response = $this->import('kardex.xlsx', 'kardex');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 10,
            'imported' => 40
        ]);
    }
    public function testImportMediosEnterados() {
        $response = $this->import('mediosEnterados.xlsx', 'mediosEnterados');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 26
        ]);
    }


    public function testImportEstudiantes() {
        $this->seed('EstadosCivilesTableSeeder');
        $this->seed('NacionalidadesTableSeeder');
        $this->seed('EspecialidadesTableSeeder');
        $this->seed('ModalidadesEstudiantesTableSeeder');
        $this->seed('MediosEnteradosTableSeeder');
        $this->seed('PeriodosTableSeeder');
        $this->seed('EstadosEstudiantesTableSeeder');
        $response = $this->import('estudiantes.xlsx', 'estudiantes');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 50
        ]);
    }

    public function testImportEstudiantesError() {
        $this->seed('EstadosCivilesTableSeeder');
        $this->seed('NacionalidadesTableSeeder');
        $this->seed('EspecialidadesTableSeeder');
        $this->seed('ModalidadesEstudiantesTableSeeder');
        $this->seed('MediosEnteradosTableSeeder');
        $this->seed('PeriodosTableSeeder');
        $this->seed('EstadosEstudiantesTableSeeder');
        $response = $this->import('estudiantes_error.xlsx', 'estudiantes');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 28,
            'imported' => 22
        ]);
    }

    public function testImportEspecialidades()
    {
        $this->seed('NivelesAcademicosTableSeeder');
        $this->seed('TiposPlanesEspecialidadesTableSeeder');
        $this->seed('ModalidadesEspecialidadesTableSeeder');

        $response = $this->import('especialidades.xlsx', 'especialidades');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 40
        ]);
        
        $this->assertDatabaseHas('especialidades',['clave' => 'LD', 'modalidad_id' => 1]);
        $this->assertDatabaseHas('especialidades',['clave' => 'MC','modalidad_id' => 1]);
        $this->assertDatabaseHas('especialidades',['clave' => 'LPE', 'modalidad_id' => 1, 'nivel_academico_id' => 3]);
        $this->assertDatabaseHas('especialidades',['clave' => 'LAN', 'modalidad_id' => 2]);
        $this->assertDatabaseHas('especialidades',['clave' => 'LN2', 'modalidad_id' => 2]);
        $this->assertDatabaseHas('especialidades',['clave' => 'MAA', 'modalidad_id' => 1]);

        $this->assertDatabaseHas('especialidades',['clave' => 'LF', 'tipo_plan_especialidad_id' => 3]);
        $this->assertDatabaseHas('especialidades',['clave' => 'LPN', 'tipo_plan_especialidad_id' => 2, 'nivel_academico_id' => 2]);
        $this->assertDatabaseHas('especialidades',['clave' => 'LII', 'tipo_plan_especialidad_id' => 1]);

        $this->assertDatabaseHas('especialidades',['clave' => 'LC', 'nivel_academico_id' => 1]);
        $this->assertDatabaseHas('especialidades',['clave' => 'LP', 'nivel_academico_id' => 2]);
        $this->assertDatabaseHas('especialidades',['clave' => 'LD3', 'nivel_academico_id' => 1]);
    }

    public function testImportDocentes()
    {
        $this->seed('TitulosTableSeeder');
        $this->seed('NacionalidadesTableSeeder');
        $this->seed('EstadosCivilesTableSeeder');

        $response = $this->import('docentes.xlsx', 'docentes');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 30
        ]);

        $this->assertDatabaseHas('usuarios',['email' => '125@unitesba.edu.mx']);
        $this->assertDatabaseHas('usuarios',['email' => '111@unitesba.edu.mx']);
        $this->assertDatabaseHas('usuarios',['email' => '140@unitesba.edu.mx']);

        $this->assertDatabaseHas('datos_generales',[
            'curp' => 'LPCA', 
            'telefono_casa' => '61 3 66 05', 
            'telefono_personal' => '461 182 37 10', 
            'fecha_registro' => '1970-01-01',     
            'sexo' => 'O',
            'estado_civil_id' => 2, # Married
            'nacionalidad_id' => 48 # Spanish nationality
        ]);
        $this->assertDatabaseHas('datos_generales',[
            'curp' => 'HRLO', 
            'fecha_nacimiento' => '1899-11-30', 
            'calle_numero' => 'Antonio García Cubas', 
            'colonia' => 'Alfredo V. Bonfil', 
            'codigo_postal' => 38050, 
            'localidad_id' => 94493,
            'estado_civil_id' => 1, # Single
            'nacionalidad_id' => 104 # Mexican nationality
        ]);
        $this->assertDatabaseHas('datos_generales',[
            'curp' => 'CAPG', 
            'nombre' => 'GERARDO', 
            'apaterno' => 'CALDERA', 
            'estado_civil_id' => 3, # Divorced
            'sexo' => 'M',
            'nacionalidad_id' => 115 # American nationality
        ]);

        $this->assertDatabaseHas('docentes',[
            'codigo' => '10', 
            'rfc' => 'HRMU', 
            'dato_general_id' => 10, 
            'usuario_id' => 10,
            'titulo_id' => 2 # Master
        ]);
        $this->assertDatabaseHas('docentes',[
            'codigo' => '7', 
            'rfc' => 'LPCA', 
            'dato_general_id' => 7, 
            'usuario_id' => 7,
            'titulo_id' => 1, # Bachelor 
        ]);
        $this->assertDatabaseHas('docentes',[
            'codigo' => '15', 
            'rfc' => null, 
            'dato_general_id' => 15, 
            'usuario_id' => 15,
            'titulo_id' => 3, # PhD
        ]);
        $this->assertDatabaseHas('docentes',[
            'codigo' => '1', 
            'dato_general_id' => 1,
            'usuario_id' => 1,
            'titulo_id' => 2 # Master
        ]);
    }

    public function testImportDocentesError()
    {
        $this->seed('TitulosTableSeeder');
        $this->seed('NacionalidadesTableSeeder');
        $this->seed('EstadosCivilesTableSeeder');

        $response = $this->import('docentes_error.xlsx', 'docentes');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 10,
            'imported' => 20
        ]);
        $this->assertDatabaseMissing('datos_generales', ['curp' => 'CAPG']); # Inexistent degree
        $this->assertDatabaseMissing('usuarios', ['email' => '140@unitesba.edu.mx']);
        $this->assertDatabaseMissing('datos_generales', ['curp' => 'TRRE']); # Repeated code
        $this->assertDatabaseMissing('usuarios', ['email' => '116@unitesba.edu.mx']);
        $this->assertDatabaseMissing('datos_generales', ['curp' => 'HRMU']); # Empty code
        $this->assertDatabaseMissing('usuarios', ['email' => '120@unitesba.edu.mx']);
        $this->assertDatabaseMissing('datos_generales', ['curp' => 'MRLA']); # Empty locality id
        $this->assertDatabaseMissing('datos_generales', ['curp' => 'MANC']); # # Empty birthdate
        $this->assertDatabaseMissing('datos_generales', ['curp' => 'GAME']); # Empty sex
        $this->assertDatabaseMissing('datos_generales', ['curp' => 'AGMF']); # Empty email
        $this->assertDatabaseMissing('datos_generales', ['curp' => 'ARMO']); # Empty password
        $this->assertDatabaseMissing('datos_generales', ['curp' => 'BAGF']); # Repeated email
        $this->assertDatabaseMissing('datos_generales', ['nombre' => 'DAVID', 'apaterno' => 'GARCIA', 'amaterno' => 'AGUIRRE']); # Empty curp
        
        $this->assertTrue(\App\Models\DatoGeneral::count() === 20);
        $this->assertTrue(\App\Models\Usuario::count() === 21); # 1 extra user needed to authenticate the API calls
        $this->assertTrue(\App\Models\Docente::count() === 20);
    }

    public function testImportEspecialidadesError()
    {
        $this->seed('NivelesAcademicosTableSeeder');
        $this->seed('TiposPlanesEspecialidadesTableSeeder');
        $this->seed('ModalidadesEspecialidadesTableSeeder');

        $response = $this->import('especialidades_error.xlsx', 'especialidades');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 5,
            'imported' => 5
        ]);
    }

    /**
     * Remove the leading dash to test it.
     * Warning: It will take too much time.
     */
    public function _testImportEspecialidadeseLarge()
    {
        $this->seed('NivelesAcademicosTableSeeder');
        $this->seed('TiposPlanesEspecialidadesTableSeeder');
        $this->seed('ModalidadesEspecialidadesTableSeeder');

        $response = $this->import('especialidades_large.xlsx', 'especialidades');
        $response->assertOk();
        $response->assertJsonFragment([
            'errorCount' => 0,
            'imported' => 21160
        ]);        
    }
}