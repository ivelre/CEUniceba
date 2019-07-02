@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Estudiantes
@endsection

@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s11 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#academicos" class="breadcrumb">Académicos</a>
		        <a href="{{route('estudiantes.index')}}" class="breadcrumb">Estudiantes</a>
		      </div>
		    </div>
		  </nav>
		</div>

		<div class="row blue white-text">
			<div class="hide-on-med-and-up">
				<br>
			</div>
			<div class="col s10 offset-s1">
					<h5>Estudiantes</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
					<p>Lista de estudiantes registrados en la Institución.</p>
			</div>
			<div class="col m5 right-align hide-on-small-only">
					<a href="{{route('estudiantes.create')}}" class="waves-effect waves-light btn center-align blue darken-2"><i class="material-icons left">add</i>Nuevo estudiante</a>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col s10 offset-s1">
			<table id="table_estudiantes" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Matricula</th>
                <th>Nombre</th>
                <th>Grupo</th>
                <th>Datos generales</th>
                <th>Otros datos</th>
                <th>Acciones</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Matricula</th>
                <th>Nombre</th>
                <th>Grupo</th>
                <th>Datos generales</th>
                <th>Otros datos</th>
                <th>Acciones</th>
                <th>Editar</th>
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
	<script type="text/javascript" src="{{ asset('js/admin/academicos/estudiantes.js') }}"></script>
@endsection