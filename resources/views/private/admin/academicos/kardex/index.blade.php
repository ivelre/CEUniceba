@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Examenes
@endsection

@section('content')

	<div class="row">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Kardex de {{$estudiante->dato_general->nombre}} {{$estudiante->dato_general->apaterno}} {{$estudiante->dato_general->amaterno}}</h4>
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('estudiantes.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			<br>
	
			<div class="section">
				<p>No. de Matrícula: {{ $estudiante->matricula }}</p>
				<p>Semestre: {{ $estudiante->semestre }}</p>
				<p>Estado: {{ $estudiante->estado_estudiante->estado_estudiante }}</p>
				<p>Especialida: {{ $estudiante->especialidad->especialidad }}</p>
			</div>

			<input type="hidden" id="estudiante_id" name="estudiante_id" value="{{ $estudiante->id }}">

			<table id="table_kardex" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Clave</th>
                <th>Asignatura</th>
                <th>Calificación</th>
                <th>Oportunidad</th>
                <th>Semestre</th>
                <th>Periodo</th>
                <th>Año</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Clave</th>
                <th>Asignatura</th>
                <th>Calificación</th>
                <th>Oportunidad</th>
                <th>Semestre</th>
                <th>Periodo</th>
                <th>Año</th>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('/js/admin/academicos/kardex.js') }}"></script>
@endsection