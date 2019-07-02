@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Fechas de certificados
@endsection

@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s10 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#configuraciones" class="breadcrumb">Configuraciones</a>
		        <a href="#!" class="breadcrumb">Fechas de certificados</a>
		      </div>
		    </div>
		  </nav>
		</div>

		<div class="row blue white-text">
			<div class="hide-on-med-and-up">
				<br>
			</div>
			<div class="col s10 offset-s1">
					<h5>Fechas de certificados</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
					<p>Lista de fechas de certificados.</p>
			</div>
			<div class="col m5 right-align hide-on-small-only">
					<a href="#nueva_fecha" class="modal-trigger waves-effect waves-light btn center-align blue darken-2"><i class="material-icons left">add</i>Nueva fecha</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s10 offset-s1">

			<table id="table_estados_estudiantes" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Texto</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($fechas as $fecha)
        	<tr>
        		<td>{{ $fecha -> fecha_certificado }}</td>
        		<td>{{ $fecha -> fecha }}</td>
        		<td>
        			<a onclick="editFecha({{ $fecha -> id }},'{{ $fecha -> fecha_certificado }}')" href="#nueva_fecha" class="btn-floating btn-meddium waves-effect waves-light edit-estado-estudiante modal-trigger "><i class="material-icons circle green">mode_edit</i></a>
        		</td>
        		<td>
        			<a onclick="deleteFecha({{ $fecha -> id }},'{{ $fecha -> fecha }}')" class="btn-floating btn-meddium waves-effect waves-light edit-estado-estudiante"><i class="material-icons circle red">close</i></a>
        		</td>
        	</tr>
        	@endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Fecha</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
		</div>
	</div>

	<div class="fixed-action-btn hide-on-med-and-up">
    <a href="#!" class="btn-floating btn-large blue darken-2">
      <i class="large material-icons">add</i>
    </a>
  </div>

	@include('private.admin.configuraciones.fechas_certificado.modals.fechas')
@endsection

@section('script')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">
	$('.modal').modal();
	$('#guardar_fecha_certificado').on('click', function(event) {
		if($("#fecha").val() == '')
			swal('Favor de seleccionar una fecha')
		else{
			axios.post('{{ route('fechas_certificado.store') }}',{id:$("#id").val(),fecha_certificado:$("#fecha_certificado").val(),_token:'{{ csrf_token() }}'})
			.then(function (response) {
				location.reload();
			})
			.catch(function (error) {
				swal('Algo salió mal.')
			})
		}
	});
	
	function deleteFecha(id, fecha){
		Swal({
			title: '¿Deseas eliminar la fecha ' + fecha + '?',
			text: "Esta acción no es revertible.",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si'
		}).then((result) => {
			if (result.value) {
				axios.post('{{ route('fechas_certificado.destroy') }}',{id,_token:'{{ csrf_token() }}'})
				.then(function (response) {
					location.reload();
				})
				.catch(function (error) {
					swal('Algo salió mal.')
				})
			}
		})
	}

	function editFecha(id,fecha){
		$("#id").val(id)
		$("#fecha_certificado").val(fecha)
	}
</script>
@endsection