@extends('private.admin.layouts.scaffold')

@section('title')
	Nuevo período
@endsection

@section('content')

	<div class="row">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Nuevo período</h4>
			</div>
			<div class="divider"></div>
			<h5><a class="valign-wrapper" href="{{route('periodos.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			<br>
			
			<form id="form_periodo" class="col s12" action="{{ route('periodos.store') }}" method="POST" novalidate="novalidate">

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
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('/js/admin/escolares/form.periodo.js') }}"></script>
@endsection