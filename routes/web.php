<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('/',function(){return redirect(route('showLoginForm'));})->name('home');

// LogIn
Route::get('/login','Auth\LoginController@showLoginForm')->name('showLoginForm');
Route::post('/login','Auth\LoginController@login')->name('login');

// LogOut
Route::get('/logout','Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['login']], function () {
	
	// Admin
	Route::prefix('admin')->group(function () {
		
		// Menu Principal
		Route::get('menu','Admin\MenuController@index')->name('admin.menu');

		// Academicos
		Route::prefix('academicos')->group(function () {

			// Estudiantes
			Route::resource('estudiantes','Admin\Academicos\EstudianteController')
				->except(['destroy']);
			Route::get('estudiantes/dato/general/{datoGeneral}','Admin\Academicos\EstudianteController@datoGeneral')->name('getDatoGeneral');
			Route::post('estudiantes/guardar','Admin\Academicos\EstudianteController@guardar')->name('estudiante.guardar');

			Route::get('estudiantes/datos/generales','Admin\Academicos\EstudianteController@searchByName')->name('estudiante.datos.generales');

			// InstitutosProcedencias
			Route::resource('institutos_procedencias','Admin\Academicos\InstitutoProcedenciaController')
				->only('store');

			// Empresas
			Route::resource('empresas','Admin\Academicos\EmpresaController')
				->only('store');

			// Kardex
			// Route::get('kardex/ver','Admin\Academicos\KardexController@ver')->name('verKardex');
			Route::get('kardex/ver/{matricula_id}','Admin\Academicos\KardexController@verEstudiante')->name('verKardex');
			Route::post('kardex/ver/nuevo','Admin\Academicos\KardexController@newKardexElemente')->name('NuevoElementoKardex');
			Route::post('kardex/ver/expediente','Admin\Academicos\KardexController@expedienteKardex')->name('expedienteKardex');
			Route::post('kardex/ver/borrar','Admin\Academicos\KardexController@deleteKardexElemente')->name('borrarElementoKardex');
			Route::resource('kardex','Admin\Academicos\KardexController')
				->only(['index','create','store','show']);
			Route::get('kardex/reticula/{plan_especialidad_id}/','Admin\Academicos\KardexController@getReticulaPlan')->name('getReticulaPlan');
			Route::get('kardex/calificaciones/{estudiante_id}/','Admin\Academicos\KardexController@getCalificaciones')->name('getCalificaciones');

			//Menu Reportes
			Route::get('reportes','Admin\Academicos\reportesController@index')
				->name('reportes');

			// boletas
			Route::get('boletas/{oportunidad_id}','Admin\Academicos\reportesController@boletas')
				->name('boleta');
			Route::get('boletas/estudiantes/{periodo_id}/{oportunidad_id}','Admin\Academicos\reportesController@getEstudiantes')
				->name('getEstudiantesBoleta');

			// Docentes
			Route::resource('docentes','Admin\Academicos\DocenteController')
				->except('show');

			// Clases
			Route::resource('clases','Admin\Academicos\ClaseController')
				->except('show');

			// Grupos
			Route::resource('grupos','Admin\Academicos\GrupoController')
				->only(['index','store','destroy']);
			Route::get('estudiante','Admin\Academicos\GrupoEstudianteController@get')
				->name('estudiante.get');

			Route::prefix('grupos')->group(function () {
				Route::post('/guardar/calificacion', 'Admin\Academicos\GrupoController@guardarCalificacion')->name('guardar.calificacion');
				Route::post('/delete', 'Admin\Academicos\GrupoController@deleteGrupoKardex')->name('delete.grupo.kardex');
			});
		});


		// PDF's
		Route::prefix('pdf')->group(function() {
			// Certificado total
			/**
			 * @param id_estudiante: Id del estudiante en la base de datos
			 * @param certificado: Número del certificado
			 * @param fecha: Hora unix en que se emite el certificado
			*/
			Route::get('/certificado/{tipo_certificado}/{id_estudiante}/{certificado}/{id_fecha_certificado}', 'Admin\PDFController@certificado');
			// Route::get('/certificado_total/{id_estudiante}/{certificado}/{fecha}', 'Admin\PDFController@certificadoTotal');

			Route::post('/grupo/setGruposPrint', 'Admin\Academicos\GrupoController@setGruposPrint')->name('pdf.setGruposPrint');
			Route::post('/grupo/gruposPrint', 'Admin\Academicos\GrupoController@gruposPrint')->name('pdf.gruposPrint');
			Route::get('/grupo/calificaciones/{tipo}', 'Admin\PDFController@calificaciones')->name('pdf.grupo.calificaciones');
			Route::get('/grupo/lista', 'Admin\PDFListaGrupoController@lista')->name('pdf.grupo.lista');
			Route::get('/grupo/setDate/{date}/', 'Admin\Academicos\GrupoController@setGlovalDate')->name('pdf.setDate');

			Route::get('/boleta/{estudiante_id}/{periodo_id}/{oportunidad_id}', 'Admin\PDFBoletaController@boleta')->name('pdf.boleta');

			Route::get('/ficha/inscripcion/{estudiante_id}', 'Admin\PDFfichaInscripcionController@ficha')->name('pdf.fichaInscripcion');
		});


		// Escolares
		Route::prefix('escolares')->group(function () {

			// Asignaturas
			Route::resource('asignaturas','Admin\Escolares\AsignaturaController')
				->only(['index', 'store', 'update']);

			// Periodos
			Route::resource('periodos','Admin\Escolares\PeriodoController')
				->except('show');
			Route::prefix('periodos')->group(function () {
				
				Route::resource('fechas_examenes','Admin\Escolares\FechaExamenController')
					->only(['index', 'store', 'update', 'destroy']);

			});

			// Especialidades
			Route::resource('especialidades','Admin\Escolares\EspecialidadController')
				->only(['index','store','update']);
			
			// PlanEspecialidad
			Route::resource('/planes_especialidades','Admin\Escolares\PlanEspecialidadController');

			// Reticulas
			Route::resource('reticulas','Admin\Escolares\ReticulaController')
				->only(['store','destroy']);
			Route::get('reticulas/asignaturas','Admin\Escolares\AsignaturaReticulaController@asignaturas_periodo')
				->name('reticulas.asignaturas');
			Route::get('reticulas/asignaturas_requisito/{reticula_id}','Admin\Escolares\AsignaturaReticulaController@asignaturas_requisito')
				->name('reticulas.asignaturas_requisito');

			// Requisitos
			Route::resource('requisitos_reticulas','Admin\Escolares\RequisitoReticulaController')
			->only(['store','destroy']);

		});

		// Configuraciones
		Route::prefix('configuraciones')->group(function () {

			// Estados de estudiantes
			Route::resource('estados_estudiantes','Admin\Configuraciones\EstadoEstudianteController')
				->only(['index','store','update','destroy']);

			// Títulos del docente
			Route::resource('titulos_docentes','Admin\Configuraciones\TituloDocenteController')
				->only(['index','store','update','destroy']);

			// Títulos del docente
			Route::resource('tipos_examenes','Admin\Configuraciones\TipoExamenController')
				->only(['index','store','update','destroy']);

			// Oportunidades
			Route::resource('oportunidades','Admin\Configuraciones\OportunidadController')
				->only(['index','store','update','destroy']);

			// Niveles y grados
			Route::resource('niveles_academicos','Admin\Configuraciones\NivelAcademicoController')
				->only(['index','store','update','destroy']);

			// Fechas de certificado
			Route::resource('fechas_certificado','Admin\Configuraciones\fechasCertificadoController')
				->only(['index','store','update']);
			Route::post('/fechas_certificado/delete','Admin\Configuraciones\fechasCertificadoController@destroy') -> name('fechas_certificado.destroy');

		});

		// Datatable
		Route::prefix('datatable')->group(function () {

			// Estudiantes
			Route::get('estudiantes','Admin\DataTableController@estudiantes')
				->name('estudiantes.get');
			
			// Asignaturas
			Route::get('asignaturas','Admin\DataTableController@asignaturas')
				->name('asignatuas.get');

			// Periodos
			Route::get('periodos','Admin\DataTableController@periodos')
				->name('periodos.get');

			// Fechas de Examenes
			Route::get('fechas_examenes','Admin\DataTableController@fechas_examenes')
				->name('fechas_examenes.get');

			// Especialidades
			Route::get('especialidades','Admin\DataTableController@especialidades')
				->name('especialidades.get');

			// Planes especialidades
			Route::get('planes_especialidades','Admin\DataTableController@planes_especialidades')
				->name('planes_especialidades.get');

			// Docentes
			Route::get('docentes','Admin\DataTableController@docentes')
				->name('docentes.get');

			// Clases
			Route::get('clases','Admin\DataTableController@clases')
				->name('clases.get');

			// Kardex
			Route::get('kardex','Admin\DataTableController@kardex')
				->name('kardex.get');

			// Grupos
			Route::get('grupos','Admin\DataTableController@grupos')
				->name('grupos.get');

			// Estados de estudiantes
			Route::get('estados_estudiantes','Admin\DataTableController@estados_estudiantes')
				->name('estados_estudiantes.get');

			// Títulos de docentes
			Route::get('titulos_docentes','Admin\DataTableController@titulos_docentes')
				->name('titulos_docentes.get');

			// Títulos de docentes
			Route::get('tipos_examenes','Admin\DataTableController@tipos_examenes')
				->name('tipos_examenes.get');

			// Oportunidades
			Route::get('oportunidades','Admin\DataTableController@oportunidades')
				->name('oportunidades.get');


			// Oportunidades
			Route::get('niveles_academicos','Admin\DataTableController@niveles_academicos')
				->name('niveles_academicos.get');

		});

		// Selects
		Route::prefix('select')->group(function () {

			// Especialidades
			Route::get('especialidades_nivel','Admin\SelectController@especialidades_nivel')
				->name('select.especialidades_nivel');

			// Especialidades
			Route::get('planes_especialidades','Admin\SelectController@planes_especialidades')
				->name('select.planes_especialidades');

			// Asignaturas Reticula
			Route::get('asignaturas_reticula','Admin\SelectController@asignaturas_reticula')
				->name('select.asignaturas_reticula');

			// Asignaturas Requisito
			Route::get('asignaturas_requisito','Admin\SelectController@asignaturas_requisito')
				->name('select.asignaturas_requisito');

			// Municipios
			Route::get('municipios','Admin\SelectController@municipios')
				->name('select.municipios');

			// Localidades
			Route::get('localidades','Admin\SelectController@localidades')
				->name('select.localidades');

		});

		Route::prefix('excel')->group(function () {
			Route::get('','Admin\ExcelController@index') -> name('excel');
			Route::get('/export','Admin\ExcelController@export') -> name('excel.export');
			Route::post('/import','Admin\ExcelController@import') -> name('excel.import');
		});
		
	});

});