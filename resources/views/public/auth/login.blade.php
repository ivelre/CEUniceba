@extends('public.auth.layouts.scaffold')

@section('title')
	Iniciar Sesión
@endsection

@section('content')
	<div class="row z-depth-4 white">
		<form class="col s12" action="{{route('login')}}" method="post" >
			
			<div class="row">
        <h1 class="header center blue-text text-darken-4">UNICEBA</h1>
      </div>
      
      <div class="row">
        <div class="input-field col s12">
					<input id="email" type="email" class="validate" required name="email">
					<label for="email">Usuario</label>
				</div>
		    <div class="input-field col s12">
					<input id="password" type="password" class="validate" required name="password">
					<label for="password">Password</label>
				</div>
			</div>

      <div class="row">
				<div class="input-field col s12">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button class="btn btn-large waves-effect waves-light blue darken-4" type="submit" name="action" style="width: 100%">Iniciar
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>

			<div class="row center">
        <div class="center-align">
					@if(\Session::has('msg'))
						<span class="blue-text">{{ \Session::get('msg')}}</span>
					@endif
				</div>
      </div>
    </form>
	</div>
@endsection
