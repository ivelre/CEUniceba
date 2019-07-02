@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Clases
@endsection

@section('content')
	<div class="row">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Editar clase</h4>
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('clases.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			
			
			<form id="form_clase" class="col s12" action="{{asset('/')}}admin/academicos/clases/{{$clase->id}}" method="post" novalidate="novalidate">
				
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="_method" value="put"/>

				<input type="hidden" name="periodo_id" value="{{ $clase->periodo_id }}">
				<input type="hidden" name="especialidad_id" value="{{ $clase->especialidad_id }}">
				<input type="hidden" name="clase_id" value="{{$clase->id}}">

				@include('private.admin.academicos.clases.forms.form')

				<div class="row">
					<div class="input-field col s12">
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
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('js/admin/academicos/form.clases.js') }}"></script>
@endsection