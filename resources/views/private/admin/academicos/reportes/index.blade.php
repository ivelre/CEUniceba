@extends('private.admin.layouts.scaffold')

@section('title')
	Boletas
@endsection

@section('content')

	<div class="row" id="v-app">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Reportes</h4>
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('estudiantes.index')}}"><i class="material-icons">arrow_back</i>Regresar</a></h5>
			<br>
			
			<div class="section" id="academicos">
				<h5>Boletas</h5>
				<p>Boletas de los estudiantes por periodo.</p>
			</div>
			<div class="divider"></div>
			<div class="row">
				<div class="col s6 m4">
					<a href="{{ route('boleta',1) }}">
						<div class="center promo hoverable">
							<i class="material-icons">list_alt</i>
							<p class="promo-caption">Ordinarias</p>
						</div>
					 </a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('boleta',2) }}">
						<div class="center promo hoverable">
							<i class="material-icons">list_alt</i>
							<p class="promo-caption">Extraordinarias</p>
						</div>
					 </a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('boleta',3) }}">
						<div class="center promo hoverable">
							<i class="material-icons">list_alt</i>
							<p class="promo-caption">Especiales</p>
						</div>
					 </a>
				</div>
			</div>
      
		</div>
	</div>
@endsection

@section('script')
@endsection
