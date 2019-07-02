@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA
@endsection

@section('content')
	
	<!-- Parallax -->
	<div class="parallax-container valign-wrapper hide-on-small-only">
		<div class="parallax"><img src="{{ asset('/') }}images/banner.jpg"></div>
		<div class="section no-pad-bot">
			<div class="container">
				<div class="row center valign-wrapper banner-text" style="margin: auto;">
					<h5 class="header col s12 light shadow-text">GESTOR ESCOLAR</h5>
				</div>
			</div>
		</div>
	</div>

	<!-- Logos -->
	<div class="row">
		<div class="col s10 offset-s1 ">

			<div class="section" id="academicos">
				<h5>Académicos</h5>
				<p>Acciones académicas de consulta rápida.</p>
			</div>
			<div class="divider"></div>
			<div class="row">
				<div class="col s6 m4">
					<a href="{{ route('estudiantes.index') }}">
						<div class="center promo hoverable">
							<i class="material-icons">school</i>
							<p class="promo-caption">Estudiantes</p>
						</div>
					</a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('docentes.index') }}">
						<div class="center promo hoverable">
							<i class="material-icons">work</i>
							<p class="promo-caption">Docentes</p>
						</div>
					</a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('clases.index') }}">
						<div class="center promo hoverable">
							<i class="material-icons">import_contacts</i>
							<p class="promo-caption">Clases</p>
						</div>
					 </a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('verKardex',0) }}">
						<div class="center promo hoverable">
							<i class="material-icons">file_copy</i>
							<p class="promo-caption">Kardexs</p>
						</div>
					 </a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('reportes') }}">
						<div class="center promo hoverable">
							<i class="material-icons">assessment</i>
							<p class="promo-caption">Reportes</p>
						</div>
					 </a>
				</div>
			</div>

			<div class="section" id="escolares">
				<h5>Escolares</h5>
				<p>Acciones escolares de administración.</p>
			</div>
			<div class="divider"></div>
			<div class="row">
				<div class="col s6 m4">
					<a href='{{ route('asignaturas.index') }}'>
						<div class="center promo hoverable">
							<i class="material-icons">create</i>
							<p class="promo-caption">Asignaturas</p>
						</div>
					</a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('periodos.index') }}">
						<div class="center promo hoverable">
							<i class="material-icons">date_range</i>
							<p class="promo-caption">Períodos</p>
						</div>
					</a>

				</div>
				<div class="col s6 m4">
					<a href="{{ route('especialidades.index') }}">
						<div class="center promo hoverable">
							<i class="material-icons">build</i>
							<p class="promo-caption">Especialidades</p>
						</div>
					</a>
				</div>
			</div>

			<div class="section" id="configuraciones">
				<h5>Configuraciones</h5>
				<p>Configuración de estados y dependencias.</p>
			</div>
			<div class="divider"></div>
			<div class="row">
				<div class="col s6 m4">
					<a href="{{ route('estados_estudiantes.index') }}">
						<div class="center promo  hoverable">
							<i class="material-icons">school</i>
							<p class="promo-caption">Estados de estudiante</p>
						</div>
					</a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('titulos_docentes.index') }}">
						<div class="center promo  hoverable">
							<i class="material-icons">work</i>
							<p class="promo-caption">Títulos de profesor</p>
						</div>
					</a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('tipos_examenes.index') }}">
						<div class="center promo hoverable">
							<i class="material-icons">description</i>
							<p class="promo-caption">Tipos de exámenes</p>
						</div>
					</a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('oportunidades.index') }}">
						<div class="center promo hoverable">
							<i class="material-icons">autorenew</i>
							<p class="promo-caption">Oportunidades de clase</p>
						</div>
					</a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('niveles_academicos.index') }}">
						<div class="center promo hoverable">
							<i class="material-icons">class</i>
							<p class="promo-caption">Niveles y grados</p>
						</div>
					</a>
				</div>
				<div class="col s6 m4">
					<a href="{{ route('fechas_certificado.index') }}">
						<div class="center promo hoverable">
							<i class="material-icons">file_copy</i>
							<p class="promo-caption">Fechas de certificados</p>
						</div>
					</a>
				</div>
			</div>

		</div>
	</div>
@endsection
