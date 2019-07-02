@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Examenes
@endsection

@section('content')

	<div class="row">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Nuevo examen</h4>
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('periodos.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			<br>
	
			<form id="form_fecha_examen" novalidate="novalidate">
				<div class="section">
					<input id="periodo_id" name="periodo_id" type="hidden" value="{{ $periodo }}">
					<div class="input-field col s12">
						<i class="material-icons prefix">list</i>
						<select id="tipo_examen_id" name="tipo_examen_id">
							@foreach($tipos_examenes as $tipo_examen)
								@if($tipo_examen -> id == 1)
									<option value="{{ $tipo_examen -> id }}" selected>{{ $tipo_examen -> tipo_examen }}</option>
								@else
									<option value="{{ $tipo_examen -> id }}">{{ $tipo_examen -> tipo_examen }}</option>
								@endif
							@endforeach
						</select>
						<label for="tipo_examen_id">Tipo de examen</label>
					</div>
					<div class="input-field col s12 m6">
						<i class="material-icons prefix">date_range</i>
						<input id="fecha_inicio" name="fecha_inicio" type="text" class="datepicker" required="" aria-required="true">
						<label for="fecha_inicio">Inicio de examen</label>
					</div>
					<div class="input-field col s12 m6">
						<i class="material-icons prefix">date_range</i>
						<input id="fecha_final" name="fecha_final" type="text" class="datepicker" required="" aria-required="true">
						<label for="fecha_final">Fin de examen</label>
					</div>
					<div class="input-field col s12">
						<i class="material-icons prefix">description</i>
						<input id="descripcion" name="descripcion" type="text">
						<label for="descripcion">Descripción</label>
					</div>
				</div><br>
				<div class="section">
					<div class="input-field col s12">
							<div class="right-align">
								<a id="cancel_fecha_examen" class="waves-effect waves-light btn red darken-2 hide">Cancelar<i class="material-icons left">clear</i></a>
								<button id="save_fecha_examen" class="waves-effect waves-light btn center-align blue darken-2" type="submit">Guardar<i class="material-icons left">send</i></button>
							</div>
						</div>
				</div>
			</form>

			<div class="section">
				<h4>Exámenes</h4>
				<div class="divider"></div>
			</div>

			<table id="table_fechas_examenes" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Examen</th>
                <th>Inicio de</th>
                <th>Fin de</th>
                <th>Descripcion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Examen</th>
                <th>Inicio de</th>
                <th>Fin de</th>
                <th>Descripcion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
		</div>
	</div>
@endsection

@section('script')
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('/js/admin/escolares/fechas_examenes.js') }}"></script>
@endsection