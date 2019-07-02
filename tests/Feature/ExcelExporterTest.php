<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExcelExporterTest extends TestCase
{
    use RefreshDatabase;

    private function export($model) {
        $user = factory(\App\Models\Usuario::class)->create();
        
        $response = $this->withSession(['usuario' => $user])
                        ->get('admin/excel/export?model='.$model);

        return $response;
    }

    public function testExportTitulos()
    {
        $this->seed('TitulosTableSeeder');
        $this->export('titulos')->assertOk();
    }

    public function testExportTiposPlanesEspecialidades()
    {
        $this->seed('TiposPlanesEspecialidadesTableSeeder');
        $this->export('tiposPlanesEspecialidades')->assertOk();
    }

    public function testExportOportunidades()
    {
        $this->seed('OportunidadesTableSeeder');
        $this->export('oportunidades')->assertOk();
    }

    public function testExportNivelesAcademicos()
    {
        $this->seed('NivelesAcademicosTableSeeder');
        $this->export('nivelesAcademicos')->assertOk();
    }

    public function testExportModalidadesEstudiantes()
    {
        $this->seed('ModalidadesEstudiantesTableSeeder');
        $this->export('modalidadesEstudiantes')->assertOk();
    }

    public function testExportEstadosEstudiantes()
    {
        $this->seed('EstadosEstudiantesTableSeeder');
        $this->export('estadosEstudiantes')->assertOk();
    }

    public function testExportAsignaturas()
    {
        factory(\App\Models\Asignatura::class, 2000)->create();
        $this->export('asignaturas')->assertOk();
    }

    public function testExportEspecialidades()
    {
        $this->seed('EspecialidadesTableSeeder');
        $this->export('especialidades')->assertOk();
    }

    public function testExportPeriodos()
    {
        #$this->seed('PeriodosTableSeeder');
        $this->export('periodos')->assertOk();
    }
}
