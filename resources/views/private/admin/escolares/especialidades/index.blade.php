@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Especialidades
@endsection

@section('content')
	<div class="row" style="margin-bottom: 0px;">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s10 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#escolares" class="breadcrumb">Escolares</a>
		        <a href="{{route('especialidades.index')}}" class="breadcrumb">Especialidades</a>
		      </div>
		    </div>
		  </nav>
		</div>
		<div class="row blue white-text">
			<div class="nav-content blue col s10 offset-s1">
				<ul id="tabs_especialidades_reticulas" class="tabs tabs-transparent">
					<li class="tab"><a href="#tab_especialidades" class="active">Lista de especialidades</a></li>
					<li class="tab"><a id="btn_tab_reticulas" href="#tab_reticulas">Retículas</a></li>
				</ul>
			</div>	
		</div>
	</div>
	
	<div id="tab_especialidades" class="row">
		<div class="row blue white-text">
			<div class="hide-on-med-and-up"><br></div>
			<div class="col s10 offset-s1">
				<h5>Especialidades</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
				<p>Gestor de especialidades.</p>
			</div>
			<div class="col m5 right-align hide-on-small-only">
				<a id="create_especialidad" class="waves-effect waves-light btn center-align blue darken-2"><i class="material-icons left">add</i>Nueva especialidad</a>
			</div>	
		</div>
		<div class="col s10 offset-s1">
			<table id="table_especialidades" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Especialidad</th>
                <th>Detalles</th>
                <th>Planes</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Codigo</th>
                <th>Especialidad</th>
                <th>Detalles</th>
                <th>Planes</th>
                <th>Editar</th>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
		</div>
	</div>

	<div id="tab_reticulas" class="row">
		<div class="row blue white-text">
			<div class="hide-on-med-and-up"><br></div>
			<div class="col s10 offset-s1">
				<h5>Retículas</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
				<p>Gestor de reticulas.</p>
			</div>
		</div>
		<div class="col s10 offset-s1">
			<br>
			<div class="section">
				<div class="input-field col s12 l4">
					<i class="material-icons prefix">school</i>
					<select id="nivel_academico">
						@foreach($niveles_academicos as $nivel_academico)
							@if($nivel_academico -> id == 1)
								<option value="{{ $nivel_academico->id }}" selected>{{ $nivel_academico->nivel_academico }}</option>
							@else
								<option value="{{ $nivel_academico->id }}">{{ $nivel_academico->nivel_academico }}</option>
							@endif
						@endforeach
					</select>
					<label>Nivel académico</label>
				</div>
				<div class="input-field col s12 l4">
					<i class="material-icons prefix">account_balance</i>
					<select id="especialidad_id">
					</select>
					<label>Especialidad</label>
				</div>
				<div class="input-field col s12 l4">
					<i class="material-icons prefix">list</i>
					<select id="plan_especialidad_id">
					</select>
					<label>Plan de Estudio</label>
				</div>
			</div>
			<br>
			<h5 id="name_reticula">Retícula de </h5>
			<div id="section_reticula" class="section">
				
			</div>
		</div>
	</div>

	@include('private.admin.escolares.especialidades.modals.especialidades')

	@include('private.admin.escolares.especialidades.modals.reticulas')

	@include('private.admin.escolares.especialidades.modals.requisitos')

	<div class="fixed-action-btn hide-on-med-and-up">
    <a href="#!" class="btn-floating btn-large blue darken-2">
      <i class="large material-icons">add</i>
    </a>
  </div>

@endsection

@section('script')
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('/js/admin/escolares/especialidades.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/admin/escolares/reticulas.js') }}"></script>
@endsection