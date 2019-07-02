@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Planes de Estudio
@endsection

@section('content')

	<div class="row">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Nuevo plan de estudios</h4>
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('especialidades.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			<br>
	
			<form id="form_plan_especialidad" novalidate="novalidate">
				<div class="section">
					<input id="especialidad_id" name="especialidad_id" type="hidden" value="{{ $especialidad }}">
					
					<div class="input-field col s12 m6">
						<i class="material-icons prefix">date_range</i>
						<input id="plan_especialidad" name="plan_especialidad" type="text" class="validate" required="" aria-required="true">
						<label for="plan_especialidad">Nombre</label>
					</div>

					<div class="input-field col s12 m6">
						<i class="material-icons prefix">exposure_plus_1</i>
						<input id="periodos" name="periodos" type="text" min="1" step="1" value="1" class="validate" required="" aria-required="true">
						<label for="periodos">Periodos</label>
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
								<a id="cancel_plan_especialidad" class="waves-effect waves-light btn red darken-2 hide">Cancelar<i class="material-icons left">clear</i></a>
								<button id="save_fecha_examen" class="waves-effect waves-light btn center-align blue darken-2" type="submit">Guardar<i class="material-icons left">send</i></button>
							</div>
						</div>
				</div>
			</form>

			<div class="section">
				<h4>Planes de estudio</h4>
				<div class="divider"></div>
			</div>

			<table id="table_planes_especialidades" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Periodos</th>
                <th>Descripcion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nombre</th>
                <th>Periodos</th>
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
	<script type="text/javascript" src="{{ asset('/js/admin/escolares/planes_especialidades.js') }}"></script>
@endsection