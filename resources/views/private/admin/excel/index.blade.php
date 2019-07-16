@extends('private.admin.layouts.scaffold')

@section('title')
	Manejo masivo de datos
@endsection

@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s11 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('excel')}}" class="breadcrumb">Importar - Exportar</a>
		      </div>
		    </div>
		  </nav>
		</div>

		<div class="row blue white-text">
			<div class="hide-on-med-and-up">
				<br>
			</div>
			<div class="col s10 offset-s1">
					<h5>Importar / exportar</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
					<p>Importación y exportación de información</p>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col s4 offset-s1">

			<div class="section" id="academicos">
				<h5>Académicos</h5>
				<p>Docentes 
					<i class="material-icons pointer" onclick="sendFile('docentes')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('docentes')">arrow_downward</i>
				</p>
				<p>Estudiantes 
					<i class="material-icons pointer" onclick="sendFile('estudiantes')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('estudiantes')">arrow_downward</i>
				</p>
				<p>Clases 
					<i class="material-icons pointer" onclick="sendFile('clases')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('clases')">arrow_downward</i>
				</p>
				<p>Grupos 
					<i class="material-icons pointer" onclick="sendFile('grupos')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('grupos')">arrow_downward</i>
				</p>
				<p>Kardex 
					<i class="material-icons pointer" onclick="sendFile('kardex')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('kardex')">arrow_downward</i>
				</p>
			</div>
			<div class="divider"></div>

			<div class="section" id="academicos">
				<h5>Escolares</h5>
				<p>Asignaturas 
					<i class="material-icons pointer" onclick="sendFile('asignaturas')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('asignaturas')">arrow_downward</i>
				</p>
				<p>Especialidades 
					<i class="material-icons pointer" onclick="sendFile('especialidades')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('especialidades')">arrow_downward</i>
				</p>
				<p>Periodos
					<i class="material-icons pointer" onclick="sendFile('periodos')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('periodos')">arrow_downward</i>
				</p>
				<p>Planes de Especialidades
					<i class="material-icons pointer" onclick="sendFile('planesEspecialidades')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('planesEspecialidades')">arrow_downward</i>
				</p>
				<p>Retículas
					<i class="material-icons pointer" onclick="sendFile('reticulas')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('reticulas')">arrow_downward</i>
				</p>
			</div>
			<div class="divider"></div>

			<div class="section" id="academicos">
				<h5>Configuración</h5>
				<p>Estados de estudiante 
					<i class="material-icons pointer" onclick="sendFile('estadosEstudiantes')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('estadosEstudiantes')">arrow_downward</i>
				</p>
				<p>Títulos de profesor 
					<i class="material-icons pointer" onclick="sendFile('titulos')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('titulos')">arrow_downward</i>
				</p>
				<p>Tipos de exámenes 
					<i class="material-icons pointer" onclick="sendFile('tiposExamenes')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('tiposExamenes')">arrow_downward</i>
				</p>
				<p>Oportunidades de clase 
					<i class="material-icons pointer" onclick="sendFile('oportunidades')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('oportunidades')">arrow_downward</i>
				</p>
				<p>Niveles y grados 
					<i class="material-icons pointer" onclick="sendFile('nivelesAcademicos')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('nivelesAcademicos')">arrow_downward</i>
				</p>
				<p>Modalidad estudiantes 
					<i class="material-icons pointer" onclick="sendFile('modalidadesEstudiantes')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('modalidadesEstudiantes')">arrow_downward</i>
				</p>
				<p>Tipos plan especialidad 
					<i class="material-icons pointer" onclick="sendFile('tiposPlanesEspecialidades')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('tiposPlanesEspecialidades')">arrow_downward</i>
				</p>
				<p>Estados Civiles 
					<i class="material-icons pointer" onclick="sendFile('estadosCiviles')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('estadosCiviles')">arrow_downward</i>
				</p>
				<p>Medios Enterados 
					<i class="material-icons pointer" onclick="sendFile('mediosEnterados')">arrow_upward</i>
					<i class="material-icons pointer" onclick="retrieveFile('mediosEnterados')">arrow_downward</i>
				</p>
			</div>

			<div class="section" id="academicos">
				<h5>Temporal</h5>
				<p>Adeudos 
					<i class="material-icons pointer" onclick="sendFile('temp_adeudos')">arrow_upward</i>
					{{-- <i class="material-icons pointer" onclick="retrieveFile('estadosEstudiantes')">arrow_downward</i> --}}
				</p>
				<p>Caja 
					<i class="material-icons pointer" onclick="sendFile('pagos_estudiantes')">arrow_upward</i>
					{{-- <i class="material-icons pointer" onclick="retrieveFile('estadosEstudiantes')">arrow_downward</i> --}}
				</p>
			</div>
			<form action="#">
		    <div class="file-field input-field">
		      <div class="btn">
		        <span>File</span>
		        <input type="file" id="file" accept=".xlsx, .xls, .csv"
						>
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" >
		      </div>
		    </div>
		  </form>
			<div class="divider"></div>

		</div>
		<div id="results" class="col s5" style="position: fixed;top: 67px; margin-left: 56%;">
			<div v-if="show">
				<div class="card-panel teal lighten-2">
					<b class="white-text">Importados: @{{ imported }}</b>
				</div>
				<div class="card-panel red darken-4">
					<b class="white-text">Errores: @{{ errorCount }}</b>
				</div>
				<div v-if="errors.length > 50"class="card-panel yellow darken-3">
					<b class="white-text">
						Al parecer hubo varios errores dentro del archivo. 
						Abre la consola (F12) para ver una lista detallada de todos ellos.
					</b>
				</div>
				
				<ul class="collapsible" v-show="errors.length" >
					<li v-for="(error,i) in errors.slice(0,51)">
						<div class="collapsible-header" @click="toggle(i)">Fila #@{{ error.row }}: @{{ error.message }}</div>
						<div class="collapsible-body"><span>@{{ error.sql }}</span></div>
					</li>
				</ul>
			</div>
			<div v-if="loading" class="progress">
      			<div class="indeterminate"></div>
  			</div>
		</div>
	</div>

@endsection

@section('script')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
<script>
let vue = new Vue({
	el: '#results',
	data: {
		errors:[],
		imported: 0,
		errorCount: 0,
		show: false,
		loading: false
	},
	methods:{
		toggle: i => $('.collapsible').collapsible('open', i)
	}
})
</script>
<script>
	function sendFile(table){
		if(vue.loading){
			Materialize.toast('Espera a que la solicitud actual termine', 4000)
			return
		}
		vue.show = false
		vue.loading = true
		var data = new FormData();
		var imagefile = document.querySelector('#file');
		data.append("model", table);
		data.append("excel", imagefile.files[0]);
		data.append("_token", '{{ csrf_token() }}');
		
		axios.post('{{ route('excel.import') }}', data, {
			headers: {'Content-Type': 'multipart/form-data'},
			onUploadProgress: progressEvent => console.log(progressEvent.loaded)
		})
		.then(res => {
			console.log(res.data)
			vue.show = true
			vue.loading = false
			vue.imported = res.data.imported
			vue.errorCount = res.data.errorCount
			vue.errors = res.data.errors
		})
		.catch(err => {
			console.log(err.response)
			const errorMessage = err.response.data.message
			vue.show = true
			vue.loading = false
			vue.errorCount = 1
			vue.imported = 0
			let error = {
				row: 0,
				sql: null
			}
			if(err.response.status === 413){
				error.message = 'Archivo muy grande. Reduzca el número de filas e intente de nuevo.'
			}else{
				if(errorMessage ){
					if(errorMessage.includes('Undefined index')){
						error.message = 'Campos requeridos no encontrados. Verifique el nombre de las columnas en su archivo.'
					}else if (errorMessage.includes('Maximum execution time')){
						error.message = 'Tiempo de espera excedido. Reduzca el número de registros o utilice IDs explícitos e intente de nuevo.'
					}
				}
			}
			vue.errors = [error]
		});
	}

	function retrieveFile(model) {
		const url = '{{ route('excel.export') }}'
		window.location = url + '?model=' + model
	}
</script>
@endsection