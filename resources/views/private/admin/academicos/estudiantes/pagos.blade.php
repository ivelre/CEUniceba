@extends('private.admin.layouts.scaffold')

@section('title')
	Pagos {{ $nombre }}
@endsection
@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s11 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#academicos" class="breadcrumb">Académicos</a>
		        <a href="{{route('estudiantes.index')}}" class="breadcrumb">Estudiantes</a>
		      </div>
		    </div>
		  </nav>
		</div>

	<div class="row blue white-text">
			<div class="hide-on-med-and-up">
				<br>
			</div>
			<div class="col s10 offset-s1">
					<h5>Pagos de {{ $nombre }}</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
					<p>Lista de pagos realizados por un alumno.</p>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col s10 offset-s1">
			<table id="table_estudiantes" class="display highlight" cellspacing="0" width="100%" data-page-length='25'>
        <thead>
            <tr>
                <th>Recibo/folio</th>
                <th>Fecha de pago</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($pagos as $pago)
        	<tr>
        		<td>{{ $pago -> recibo_folio }}</td>
        		<td>{{ $pago -> fecha_pago }}</td>
        		<td>{{ $pago -> concepto }}</td>
        		<td>{{ $pago -> cantidad }}</td>
        		<td>{{ $pago -> mes_inicio }}-{{ $pago -> mes_final }}-{{ $pago -> anio }}</td>
        	</tr>
        	@endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Recibo/folio</th>
                <th>Fecha de pago</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Descripción</th>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
		</div>
	</div>

@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@stop

@section('inline-script')
<script type="text/javascript">
		$('#table_estudiantes').DataTable( {
        order: [[ 1, "desc" ]],
        language: {
            lengthMenu: "Mostrar _MENU_ por página",
            zeroRecords: "No se han encontrado resustados",
            info: "Página _PAGE_ de _PAGES_",
            infoEmpty: "Sin registros disponibles",
            infoFiltered: "(filtered from _MAX_ total records)",
            sSearch: "Buscar:",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior"
            }
        }
    });
</script>
@stop