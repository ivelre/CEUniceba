@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Estados de estudiantes
@endsection

@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s10 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#configuraciones" class="breadcrumb">Configuraciones</a>
		        <a href="{{route('asignaturas.index')}}" class="breadcrumb">Estados de estudiantes</a>
		      </div>
		    </div>
		  </nav>
		</div>

		<div class="row blue white-text">
			<div class="hide-on-med-and-up">
				<br>
			</div>
			<div class="col s10 offset-s1">
					<h5>Estados de estudiantes</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
					<p>Lista de los estados de los estudiantes.</p>
			</div>
			<div class="col m5 right-align hide-on-small-only">
					<a id="create_estado_estudiante" class="waves-effect waves-light btn center-align blue darken-2"><i class="material-icons left">add</i>Nuevo estado</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s10 offset-s1">

			<table id="table_estados_estudiantes" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Estado</th>
                <th>Descripción</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Estado</th>
                <th>Descripción</th>
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

	@include('private.admin.configuraciones.estados_estudiantes.modals.estado_estudiante')
@endsection

@section('script')
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('/js/admin/configuraciones/estados_estudiantes.js') }}"></script>
	
@endsection