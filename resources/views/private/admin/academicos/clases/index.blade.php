@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Clases
@endsection

@section('content')
	<div class="row">
		<div class="row blue hide-on-small-only">
			<nav> 
		    <div class="nav-wrapper blue">
		      <div class="col s11 offset-s1">
		        <a href="{{route('admin.menu')}}" class="breadcrumb">Menú</a>
		        <a href="{{route('admin.menu')}}#academicos" class="breadcrumb">Académicos</a>
		        <a href="{{route('docentes.index')}}" class="breadcrumb">Clases</a>
		      </div>
		    </div>
		  </nav>
		</div>

		<div class="row blue white-text">
			<div class="hide-on-med-and-up">
				<br>
			</div>
			<div class="col s10 offset-s1">
					<h5>Clases</h5>				
			</div>
			<div class="col s10 offset-s1 m5 offset-m1">
					<p>Lista de clases por periodo.</p>
			</div>
			<div class="col m5 right-align hide-on-small-only">
					<a id="create_clase" href="{{route('clases.create')}}" class="waves-effect waves-light btn center-align blue darken-2"><i class="material-icons left">add</i>Nueva clase</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s10 offset-s1">
			<br>
			<div class="section">
				<div class="input-field col s12 l4">
					<i class="material-icons prefix">access_time</i>
					<select id="periodo_id">
						@foreach($periodos as $periodo)
							@if($loop->last)
								<option value="{{ $periodo->id }}" selected>{{ $periodo->periodo }} ({{ $periodo->anio }})</option>
							@else
								<option value="{{ $periodo->id }}">{{ $periodo->periodo }} ({{ $periodo->anio }})</option>
							@endif
						@endforeach
					</select>
					<label>Período</label>
				</div>
				<div class="input-field col s12 l4">
					<i class="material-icons prefix">school</i>
					<select id="nivel_academico_id">
						@foreach($niveles_academicos as $nivel_academico)
							@if($loop->first)
								<option value="{{ $nivel_academico->id }}" selected>{{ $nivel_academico->nivel_academico }}</option>
							@else
								<option value="{{ $nivel_academico->id }}">{{ $nivel_academico->nivel_academico }}</option>
							@endif
						@endforeach
					</select>
					<label>Nivel académico</label>
				</div>
				<div class="input-field col s12 l4">
					<i class="material-icons prefix">account_balance</i>
					<select id="especialidad_id">
					</select>
					<label>Especialidad</label>
				</div>
			</div>
			<br>
		</div>
	</div>
	
	<div class="row">
		<div class="col s10 offset-s1">
			<table id="table_clases" class="display highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código asignatura</th>
                <th>Nombre</th>
                <th>Asignatura</th>
                <th>Turno</th>
                <th>Docente</th>
                <th>Grupo</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Código asignatura</th>
                <th>Nombre</th>
                <th>Asignatura</th>
                <th>Turno</th>
                <th>Docente</th>
                <th>Grupo</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
			<h5>Imprimir calificaciones</h5>
      <div class="divider"></div>

      <div class="row">
          <br>

          <div class="col s4"><button id="openActa" class="col s12 waves-effect waves-light btn center-align blue darken-2">Ordinario<i class="material-icons left">print</i></button></div>


          <div class="col s4"><button id="openActaEX" class="col s12 waves-effect waves-light btn center-align blue darken-2">Extraordinarios<i class="material-icons left">print</i></button></div>

          <div class="col s4"><button id="openActaES" class="col s12 waves-effect waves-light btn center-align blue darken-2">Especiales<i class="material-icons left">print</i></button> </div>

      </div>

      <div class="row">

          <div class="col s4"><button id="openActaSC" class="col s12 waves-effect waves-light btn center-align blue darken-2">Ordinario S/C<i class="material-icons left">print</i></button></div>


          <div class="col s4"><button id="openActaEXSC" class="col s12 waves-effect waves-light btn center-align blue darken-2">Extraordinarios S/C<i class="material-icons left">print</i></button></div>

          <div class="col s4"><button id="openActaESSC" class="col s12 waves-effect waves-light btn center-align blue darken-2">Especiales S/C<i class="material-icons left">print</i></button> </div>


      <div class="row">
          <br>
          <div class="col s4"><br>

          <button id="openLista" class="col s12 waves-effect waves-light btn center-align blue darken-2">Lista de asistencia<i class="material-icons left">print</i></button></div>

      </div>
		</div>
	</div>

	<div class="fixed-action-btn hide-on-med-and-up">
    <a href="{{route('clases.create')}}" class="btn-floating btn-large blue darken-2">
      <i class="large material-icons">add</i>
    </a>
  </div>

@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('js/admin/academicos/clases.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script type="text/javascript">
		var grupos = []
		function setClase(clase){
			var results = [];
			var add = true;

			for(var i=0; i<grupos.length; i++) {
		    if(grupos[i].clase_id == clase) {
		      add = false
		      grupos[i].print = !grupos[i].print;
		    }
			}
			if(add)
				grupos.push({clase_id:clase,print:true})
			// console.log(grupos);
		}

		if (typeof(Storage) !== "undefined") {
		  // Store
		  // Retrieve
		  $('#periodo_id').val(localStorage.getItem("periodo_id"));
		  $('#nivel_academico_id').val(localStorage.getItem("nivel_academico_id")).change();
		  setTimeout(function(){ 
		  	$('#especialidad_id').val(localStorage.getItem("especialidad_id")).change(); 
		  	$('select').material_select();
		  }, 1000);
		}

		$('#openActa').click(function(event) {
        setPrint(1,1)
    });

    $('#openActaSC').click(function(event) {
        setPrint(2,null)
    });

    $('#openActaEX').click(function(event) {
        setPrint(1,3)
    });

    $('#openActaES').click(function(event) {
        setPrint(1,7)
    });

    $('#openActaEXSC').click(function(event) {
        setPrint(2,3)
    });

    $('#openActaESSC').click(function(event) {
        setPrint(2,7)
    });

    $('#openLista').click(function(event) {
        const {value: fruit} = Swal.fire({
              title: '¿Qué rango de mes desea imprimir?',
              input: 'select',
              inputOptions: {
                0: 'Enero - Febrero',
                1: 'Marzo -  Abril',
                2: 'Mayo - Junio',
                3: 'Julio - Agosto',
                4: 'Septiembre - Octubre',
                5: 'Noviembre - Diciembre'
              },
              inputPlaceholder: 'Seleccione un rango de mes',
              showCancelButton: false,
              inputValidator: (value) => {
                // console.log(value);
                setPrint(3,value)
              }
            })
    });

    function setPrint(tipo,oportunidad_id){
    		if(tipo != 3)
            var date = prompt("Por favor introduzca una fecha.", '{{\Session::get('date_acta')}}');
        else
            var date = '00-00-0000'
        var gruposPrint = {}
        gruposPrint._token = '{{ csrf_token() }}';
        gruposPrint.oportunidad_id = oportunidad_id;
        gruposPrint.grupos = grupos;
        // console.log(gruposPrint);

        if (date == null || date == "") {
            alert ('No ha ingresado una fecha');
        } else {
            axios.get('../pdf/grupo/setDate/' + date)
            .catch(function (error) {
                console.log(error);
            })
            axios.post('../pdf/grupo/gruposPrint',gruposPrint).then(response=>{
                if(tipo == 3)
                    window.open('../pdf/grupo/lista/'+oportunidad_id, '_blank');
                else
                    window.open('../pdf/grupo/calificaciones/' + tipo , '_blank');
            }).catch(response=>{
                console.log(response);
            })
            
        }
    }

	</script>
@endsection