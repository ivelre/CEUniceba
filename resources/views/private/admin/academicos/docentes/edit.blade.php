@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Docentes
@endsection

@section('content')
	<div class="row">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Editar docente</h4>
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('docentes.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			
			
			<form id="form_docente" class="col s12" action="{{asset('/')}}admin/academicos/docentes/{{ $docente->id }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
				<input type="hidden" name="_method" value="put"/>
				<input type="hidden" id="id" name="id" value="{{ $docente->id }}" />
				<input type="hidden" id="dato_general_id" name="dato_general_id" value="{{ $docente->dato_general_id }}" />
				@include('private.admin.academicos.docentes.forms.form')

				<div class="row">
					<div class="input-field col s12">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="right-align">
							<button class="waves-effect waves-light btn center-align blue darken-2" type="submit">Guardar
						    <i class="material-icons left">send</i>
						  </button>
						</div>
					</div>
				</div>
			</form>		
		</div>
	</div>

@endsection

@section('script')
	<script type="text/javascript">
		var fecha_nacimiento = $('#fecha_nacimiento').val();
		var $input = $('#fecha_nacimiento').pickadate({
			formatSubmit: 'yyyy-mm-dd',
			selectMonths: true,
			selectYears: 30,
			today: 'Hoy',
	    clear: 'Limpiar',
	    close: 'Ok',
		});
		var picker = $input.pickadate('picker');
		picker.set('select',fecha_nacimiento, { format: 'yyyy-mm-dd' });
	</script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('js/admin/academicos/form.docentes.js') }}">
		@if (old('municipio_id') && old('localidad_id'))
			load_municipios( {{ old('municipio_id') }} ,  {{ old('localidad_id') }});
		@endif
	</script>
@endsection