@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Períodos
@endsection

@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s10 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#escolares" class="breadcrumb">Escolares</a>
		        <a href="{{route('periodos.index')}}" class="breadcrumb">Periodos</a>
		      </div>
		    </div>
		  </nav>
		</div>

		<div class="row blue white-text">
			<div class="hide-on-med-and-up">
				<br>
			</div>
			<div class="col s10 offset-s1">
					<h5>Períodos</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
					<p>Lista de los períodos escolares.</p>
			</div>
			<div class="col m5 right-align hide-on-small-only">
					<a href="{{route('periodos.create')}}" class="waves-effect waves-light btn center-align blue darken-2"><i class="material-icons left">add</i>Nuevo período</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s10 offset-s1">

			<table id="table_periodos" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Período</th>
                <th>Año</th>
                <th>Reconocimiento Oficial</th>
                <th>DGES</th>
                <th>Fecha de Reconocimiento</th>
                <th>Fecha de Exámenes</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Período</th>
                <th>Año</th>
                <th>Reconocimiento Oficial</th>
                <th>DGES</th>
                <th>Fecha de Reconocimiento</th>
                <th>Fecha de Exámenes</th>
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

@endsection

@section('script')
	{{--
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	--}}
	<script type="text/javascript" src="{{ asset('/js/admin/escolares/periodos.js') }}"></script>
@endsection