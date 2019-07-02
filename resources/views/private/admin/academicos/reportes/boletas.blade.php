@extends('private.admin.layouts.scaffold')

@section('title')
	Boletas
@endsection

@section('content')

	<div class="row" id="v-app">
		<div class="col s10 offset-s1">

			<div class="section">
				@if($oportunidad_id == 1)
		  		<h4>Boletas ordinarias</h4>
		  	@elseif($oportunidad_id == 2)
		  		<h4>Boletas extraordinarias</h4>
		  	@else
		  		<h4>Boletas especiales</h4>
		  	@endif
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('estudiantes.index')}}"><i class="material-icons">arrow_back</i>Regresar</a></h5>
			<br>
			{{-- <div class="input-field col s6 offset-s3">
				<select id="periodo_id">
					@foreach($periodos as $periodo)
					<option value="{{ $periodo -> id }}">{{ $periodo -> periodo }}</option>
					@endforeach
				</select>
				<label>Selecciona un periodo</label>
			</div> --}}

			<table>
				<thead>
					<tr>
						<th>Matrícula</th>
						<th>Nombre</th>
						<th>Especialidad</th>
						<th>Boleta</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="estudiante in estudiantes">
						<td>@{{ estudiante.matricula }}</td>
						<td>@{{ estudiante.nombre }}</td>
						<td>@{{ estudiante.especialidad }}</td>
						<td><a :href="'{{ asset('/') }}admin/pdf/boleta/' + estudiante.id + '/' + periodo_id + '/' + oportunidad_id"  class="btn-floating btn-meddium waves-effect waves-light edit-estado-estudiante" target="_blank"><i class="material-icons circle red">list_alt</i></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Matrícula</th>
						<th>Nombre</th>
						<th>Especialidad</th>
						<th>Boleta</th>
					</tr>
				</tfoot>
			</table>

      
		</div>
	</div>
@endsection

@section('script')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
	<script type="text/javascript">
		$('select').material_select();
		$("#periodo_id").on('change', function() {
			app.periodo_id = $("#periodo_id").val()
		})

    var app = new Vue({
      el: '#v-app',
      data: {
        estudiantes: {},
        periodo_id:53,
        oportunidad_id:{{$oportunidad_id}}
      },
      methods:{
        getEstudiantes:function(){
          axios.get('{{ asset('/') }}admin/academicos/boletas/estudiantes/' + this.periodo_id + '/' + this.oportunidad_id).then(response=>{
            this.estudiantes = response.data
          }).catch(response=>{
            swal('¡Oops!','No se pudo completar la operación.','warning')
          })
        }
      }
    })

    app.getEstudiantes()
  </script>
@endsection
