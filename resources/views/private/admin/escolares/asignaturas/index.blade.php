@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Asignaturas
@endsection

@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s10 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#escolares" class="breadcrumb">Escolares</a>
		        <a href="{{route('asignaturas.index')}}" class="breadcrumb">Asignaturas</a>
		      </div>
		    </div>
		  </nav>
		</div>

		<div class="row blue white-text">
			<div class="hide-on-med-and-up">
				<br>
			</div>
			<div class="col s10 offset-s1">
					<h5>Asignaturas</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
					<p>Lista de asignaturas por nivel académico y carrera.</p>
			</div>
			<div class="col m5 right-align hide-on-small-only">
					<a id="create_asignatura" class="waves-effect waves-light btn center-align blue darken-2"><i class="material-icons left">add</i>Nueva asignatura</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s10 offset-s1">

			<table id="table_asignaturas" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Asignatura</th>
                <th>Créditos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Código</th>
                <th>Asignatura</th>
                <th>Créditos</th>
                <th>Acciones</th>
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

	@include('private.admin.escolares.asignaturas.modals.asignatura')
@endsection

@section('script')
	{{-- @include('private.admin.escolares.asignaturas.scripts.index') --}}
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('/js/admin/escolares/asignaturas.js') }}"></script>
	
@endsection