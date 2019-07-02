@extends('private.admin.layouts.scaffold')

@section('title')
	Editar período
@endsection

@section('content')

	<div class="row">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Editar período</h4>
			</div>
			<div class="divider"></div>
			<h5><a class="valign-wrapper" href="{{route('periodos.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			<br>
			
			<form id="form_periodo" class="col s12" action="{{asset('/')}}admin/escolares/periodos/{{ $periodo->id }}" method="POST" novalidate="novalidate">
				<input type="hidden" name="_method" value="put"/>
				<input type="hidden" name="id" value="{{ $periodo->id }}" />
				@include('private.admin.escolares.periodos.forms.form')

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
		var fecha_reconocimiento = $('#fecha_reconocimiento').val();
		var $input = $('#fecha_reconocimiento').pickadate({
			formatSubmit: 'yyyy-mm-dd',
			selectMonths: true,
			selectYears: 30,
			today: 'Hoy',
	    clear: 'Limpiar',
	    close: 'Ok',
		});
		var picker = $input.pickadate('picker');
		picker.set('select',fecha_reconocimiento, { format: 'yyyy-mm-dd' });
	</script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('/js/admin/escolares/form.periodo.js') }}"></script>
@endsection