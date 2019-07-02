@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Docentes
@endsection

@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s11 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#academicos" class="breadcrumb">Académicos</a>
		        <a href="{{route('docentes.index')}}" class="breadcrumb">Docentes</a>
		      </div>
		    </div>
		  </nav>
		</div>

		<div class="row blue white-text">
			<div class="hide-on-med-and-up">
				<br>
			</div>
			<div class="col s10 offset-s1">
					<h5>Docentes</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
					<p>Lista de docentes registrados en la Institución.</p>
			</div>
			<div class="col m5 right-align hide-on-small-only">
					<a href="{{route('docentes.create')}}" class="waves-effect waves-light btn center-align blue darken-2"><i class="material-icons left">add</i>Nuevo docente</a>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col s10 offset-s1">
			<table id="table_docentes" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Edad</th>
                <th>Teléfono</th>
                <th>RFC</th>
                <th>Título</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Edad</th>
                <th>Teléfono</th>
                <th>RFC</th>
                <th>Título</th>
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
    <a href="{{route('estudiantes.create')}}" class="btn-floating btn-large blue darken-2">
      <i class="large material-icons">add</i>
    </a>
  </div>

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('js/admin/academicos/docentes.js') }}"></script>
@endsection