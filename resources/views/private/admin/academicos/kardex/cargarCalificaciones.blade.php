@extends('private.admin.layouts.scaffold')

@section('title')
	Kardex
@endsection

@section('content')

	<div class="row" id="v-app">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Kardex</h4>
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('estudiantes.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			<br>

      @if($matricula == 0)
      <div class="row">
        <div class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">textsms</i>
              <input type="text" id="autocomplete-input" class="autocomplete">
              <label for="autocomplete-input">Matrícula</label>
            </div>
          </div>
        </div>
      </div>
      @endif
	
			<div class="section">
        <h3>@{{ estudiante.matricula }} <strong>-</strong> @{{ estudiante.nombre }} @{{ estudiante.apaterno }} @{{ estudiante.amaterno }}</h3>
				<h4>@{{ estudiante.especialidad }}</h4>
        {{-- <p><strong>Semestre: </strong>@{{ estudiante.semestre }} <strong>Estado: </strong>@{{ estudiante.estado_estudiante }}</p> --}}
			</div>

      <ul class="collapsible" data-collapsible="accordion">
        <li>
          <div class="collapsible-header"><i class="material-icons">file_copy</i>Certificados</div>
          <div class="collapsible-body">
             <div class="row">
              <div class="input-field col s6">
                <input placeholder="Número de certificado" id="certificado" type="text" class="validate" :value="certificado">
                <label for="numero_certificado">Número de certificado</label>
              </div>
              <div class="input-field col s6">
                <select id="fecha_certificado">
                  @foreach($fechas_certificado as $fecha)
                  <option value="{{ $fecha -> id }}">{{ $fecha -> fecha }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col s4">
                <button v-on:click="printCertificado('total')" class="waves-effect waves-light btn blue"><i class="material-icons left">print</i>Certificado total</button>
              </div>
              <div class="col s4">
                <button v-on:click="printCertificado('parcial')" class="waves-effect waves-light btn blue"><i class="material-icons left">print</i>Certificado parcial</button>
              </div>
            </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">reorder</i>Expediente</div>
          <div class="collapsible-body">
             <div class="row">
              <div class="input-field col s4">
                <input placeholder="Fecha" id="fecha_expediente" type="date" class="validate" :value="estudiante.fecha">
              </div>
              <div class="input-field col s4">
                <input placeholder="Folio" id="folio" type="text" class="validate" :value="estudiante.folio">
                <label for="folio">Folio</label>
              </div>
              <div class="input-field col s4">
                <input placeholder="Expediente" id="expediente" type="text" class="validate" :value="estudiante.expediente">
                <label for="expediente">Expediente</label>
              </div>
            </div>
            <div class="row">
              <div class="col s4">
                <button v-on:click="saveExpediente()" class="waves-effect waves-light btn blue"><i class="material-icons left">save</i>Guardar datos</button>
              </div>
            </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">school</i>Promedios</div>
          <div class="collapsible-body">
             <div class="row">
              <div class="col s8 offset-s2">
                <table class="display striped centered" cellspacing="0" width="50%">
                  <thead>
                    <tr>
                      <th>Semestre</th>
                      <th>Promedio</th>
                      <th>Aprobadas</th>
                      <th>Reprobadas</th>
                      <th>Total de materias</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="promedio in promedios">
                      <td>@{{promedio.semestre}}</td>
                      <td>@{{promedio.promedio}}</td>
                      <td>@{{promedio.aprobadas}}</td>
                      <td>@{{promedio.reprobadas}}</td>
                      <td>@{{promedio.materias}}</td>
                    </tr>
                    <tr>
                      <td><strong>@{{promGeneral.semestre}}</strong></td>
                      <td><strong>@{{promGeneral.promedio}}</strong></td>
                      <td><strong>@{{promGeneral.aprobadas}}</strong></td>
                      <td><strong>@{{promGeneral.reprobadas}}</strong></td>
                      <td><strong>@{{promGeneral.materias}}</strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">announcement</i>Estado del estudiante</div>
          <div class="collapsible-body">
             <div class="row">
              <div class="col s8 offset-s2">
                <div class="row">
                @foreach($estados_estudiante as $estado_estudiante)
                  <div class="col s3">
                    <input name="estado_estudiante_id" type="radio" id="estado_{{ $estado_estudiante -> id}}" value="{{ $estado_estudiante -> id}}" v-model="estudiante.estado_estudiante_id" v-on:change="changeEstadoEstudiante({{ $estado_estudiante -> id }})" />
                    <label for="estado_{{ $estado_estudiante -> id}}" v-on:change="changeEstadoEstudiante({{ $estado_estudiante -> id }})">{{ $estado_estudiante -> estado_estudiante}}</label>
                  </div>
                @endforeach
                <div class="col s12">
                  <div v-for="historial in estudiante.historial">
                    <label>@{{historial.estado_estudiante}} - @{{historial.descripcion}} - @{{historial.fecha_cambio}}</label><br>
                  </div>
                </div>
                </div>
              </div>
            </div>
        </li>
      </ul>
      <a href="#modal_kardex" class="modal-trigger waves-effect waves-light btn blue"><i class="material-icons left">add</i>Nueva materia</a>
			<table id="table_kardex" class="display highlight " cellspacing="0" width="100%" data-page-length='500'>
        <thead>
            <tr>
                <th>Código</th>
                <th>Asignatura</th>
                <th>Cafilicación</th>
                <th>Oportunidad</th>
                <th>Semestre</th>
                <th>Periodo</th>
                <th>Año</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="materia in materias">
                <td>@{{materia.codigo}}</td>
                <td>@{{materia.asignatura}}</td>
                <td>@{{materia.calificacion}}</td>
                <td>@{{materia.oportunidad}}</td>
                <td>@{{materia.semestre}}</td>
                <td>@{{materia.periodo}}</td>
                <td>@{{materia.anio}}</td>
                <td>
                  <a v-on:click="editarKardex(materia.id,materia.grupo_id,materia.clase_id,materia.asignatura_id,materia.oportunidad_id,materia.semestre,materia.periodo_id,materia.calificacion)" href="#modal_kardex" class="btn-floating btn-meddium waves-effect waves-light edit-estado-estudiante modal-trigger "><i class="material-icons circle green">mode_edit</i></a>
                  <a v-on:click="borrarKardex(materia.id,materia.asignatura)" class="btn-floating btn-meddium waves-effect waves-light edit-estado-estudiante"><i class="material-icons circle red">close</i>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Código</th>
                <th>Asignatura</th>
                <th>Cafilicación</th>
                <th>Oportunidad</th>
                <th>Semestre</th>
                <th>Periodo</th>
                <th>Año</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
    <br>
    {{-- <button onclick="saveKardex()" class="waves-effect waves-light btn blue"><i class="material-icons left">send</i>Guardar</button> --}}
		</div>
    @include('private.admin.academicos.kardex.modals.from')
	</div>
@endsection

@section('script')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
    // $('#table_kardex').DataTable( {
    //     language: {
    //         lengthMenu: "Mostrar _MENU_ por página",
    //         zeroRecords: "No se han encontrado resustados",
    //         info: "Página _PAGE_ de _PAGES_",
    //         infoEmpty: "Sin registros disponibles",
    //         infoFiltered: "(filtered from _MAX_ total records)",
    //         sSearch: "Buscar:",
    //         sLoadingRecords: "Cargando...",
    //         oPaginate: {
    //             sFirst: "Primero",
    //             sLast: "Último",
    //             sNext: "Siguiente",
    //             sPrevious: "Anterior"
    //         }
    //     }
    // });
    var dReticula = null
    var dClases = null
    var app = new Vue({
      el: '#v-app',
      data: {
        estudiante: {},
        materias: {},
        fecha_certificado:1,
        certificado:123,
        reticula:{},
        promedios:{},
        promGeneral:{},
        clases:{},
        asignatura_id:null,
        clase_id:null
      },
      methods:{
        changeEstadoEstudiante:function(estado_estudiante_id,estado_estudiante){
          var estEst = {}
          estEst._token = '{{ csrf_token() }}'
          estEst.estado_estudiante_id = estado_estudiante_id
          estEst.estudiante_id = this.estudiante.estudiante_id
          axios.post('{{ route('kardex.cambiar.estado.estudiante') }}',estEst).then(response=>{
              Materialize.toast('Calificación cambiada', 4000)
              this.estudiante.estado_estudiante= estado_estudiante
              axios.get('{{ asset('/') }}admin/academicos/kardex/' + this.estudiante.matricula).then(response=>{
                this.estudiante.historial = response.data.historial
              })
          }).catch(response=>{
              console.log(response);
          })
        },
        getKardex:function(){
          axios.get('{{ asset('/') }}admin/academicos/kardex/calificaciones/' + app.estudiante.estudiante_id).then(function(response) {
            app.materias = response.data
            app.calPromedio()
            app.$forceUpdate()
            app.getAsignaturas();
          })
        },
        calPromedio:function(){
          sumas = []
          mininaAprobatoria = (5 + Number(this.estudiante.nivel_academico_id))
          for (var i = 0; i < app.materias.length; i++) {
            if(sumas[app.materias[i].semestre] === undefined){
              if(Number(app.materias[i].calificacion) >= mininaAprobatoria)
                sumas[app.materias[i].semestre] = {suma:Number(app.materias[i].calificacion),materias:1,aprobadas:1,reprobadas:0}
              else
                sumas[app.materias[i].semestre] = {suma:0,materias:1,aprobadas:0,reprobadas:1}
            }
            else{
              sumas[app.materias[i].semestre].materias ++
              if(Number(app.materias[i].calificacion) >= mininaAprobatoria){
                sumas[app.materias[i].semestre].aprobadas++
                sumas[app.materias[i].semestre].suma += Number(app.materias[i].calificacion)
              }
              else
                sumas[app.materias[i].semestre].reprobadas++
            }
          }
          promedios =[]
          total = 0
          materias = 0
          aprobadas = 0
          reprobadas = 0
          for (var i = 1; i < sumas.length; i++) {
            if(sumas[i] === undefined)
              promedios[i - 1] = {semestre:i,promedio:0,materias:0}
            else{
              promedios[i - 1] = {semestre:i,promedio:(sumas[i].suma/sumas[i].aprobadas).toFixed(1),materias:sumas[i].materias,aprobadas:sumas[i].aprobadas,reprobadas:sumas[i].reprobadas}
              total += sumas[i].suma
              materias += sumas[i].materias
              aprobadas += sumas[i].aprobadas
              reprobadas += sumas[i].reprobadas
            }
          }
          promGeneral = {semestre:'Promedio total',promedio:(total/aprobadas).toFixed(1),materias,aprobadas,reprobadas}
          app.promedios = promedios
          app.promGeneral = promGeneral
          app.$forceUpdate()
        },
        printCertificado:function(tipo_certificado){
          this.certificado = $('#certificado').val()
          window.open('{{ asset('/') }}admin/pdf/certificado/'+ tipo_certificado + '/'+ app.estudiante.estudiante_id + '/'+ app.certificado + '/'+ $('#fecha_certificado').val() ,'_blank')
        },
        getAsignaturas: function(){
          axios.get('{{ asset('/') }}admin/academicos/kardex/reticula/' + this.estudiante.plan_especialidad_id).then(response => {
            this.reticula = response.data.reticula
            this.clases = response.data.clases
            dataReticula = []
            for (var i = 0; i < this.reticula.length; i++) {
              dataReticula[this.reticula[i].codigo + ' - ' + this.reticula[i].asignatura] = this.reticula[i].asignatura_id
            }
            dReticula = dataReticula;
            $('#asignatura_text').autocomplete({
              data: dataReticula,
              limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
              onAutocomplete: function(val) {
                app.asignatura_id = dataReticula[val]
                app.clase_id = null
                $("#clase_text").val('')
              },
              minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            });

            dataClases = []
            for (var i = 0; i < this.clases.length; i++) {
              dataClases[this.clases[i].clase + ' - ' + this.clases[i].asignatura + ' - ' + this.clases[i].periodo] = 
              {
                clase_id:this.clases[i].clase_id,
                asignatura_id:this.clases[i].asignatura_id,
                nombre_asignatura: this.clases[i].codigo + ' - ' + this.clases[i].asignatura
              }
            }
            dClases = dataClases;
            $('#clase_text').autocomplete({
              data: dataClases,
              limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
              onAutocomplete: function(val) {
                app.clase_id = dataClases[val].clase_id
                app.asignatura_id = dataClases[val].asignatura_id
                $("#asignatura_text").val(dataClases[val].nombre_asignatura)
              },
              minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            });
            
          })
        },
        saveExpediente:function(){
          var expediente ={
            id: this.estudiante.estudiante_id,
            fecha: $('#fecha_expediente').val(),
            folio: $('#folio').val(),
            expediente: $('#expediente').val(),
            _token:'{{ csrf_token() }}'
          }
          axios.post('{{ route('expedienteKardex') }}',expediente).then(response=>{
            swal('¡Hecho!','Se ha actualizado el expediente del alumno.','success')
          }).catch(response=>{
            swal('¡Oops!','No se pudo completar la operación.','warning')
          })
        },
        saveMateria: function(){
          var kardex ={
            estudiante_id:this.estudiante.estudiante_id,
            id:$('#id').val(),
            asignatura_id:this.asignatura_id,
            clase_id:this.clase_id,
            oportunidad_id:$('#oportunidad_id').val(),
            semestre:$('#semestre').val(),
            periodo_id:$('#periodo_id').val(),
            calificacion:$('#calificacion').val(),
            _token:'{{ csrf_token() }}'
          }
          axios.post('{{ route('NuevoElementoKardex') }}',kardex).then(response=>{
            $('#id').val('')
            $('#asignatura_text').val('')
            $('#clase_text').val('')
            this.getKardex()
            swal('¡Hecho!','Se ha actualizado la asignatura al kardex.','success')
            $('#modal_kardex').modal('close')
          }).catch(response=>{
            swal('¡Oops!','No se pudo completar la operación.','warning')
          })
        },
        editarKardex:function(id,grupo_id,clase_id,asignatura_id,oportunidad_id,semestre,periodo_id,calificacion){
          for(key in dReticula){
            if(dReticula[key] == asignatura_id)
              $('#asignatura_text').val(key);
          }
          for(key in dClases){
            if(dClases[key].clase_id == clase_id)
              $('#clase_text').val(key);
          }
          $('#id').val(id)
          app.asignatura_id = asignatura_id
          app.clase_id = clase_id
          $('#oportunidad_id').val(oportunidad_id)
          $('#semestre').val(semestre)
          $('#periodo_id').val(periodo_id)
          $('#calificacion').val(calificacion)
          $('select').material_select();
        },
        borrarKardex:function(id,asignatura){
          Swal({
            title: '¿Deseas eliminar la asignatura ' + asignatura + '?',
            text: "Esta acción no es revertible.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
          }).then((result) => {
            if (result.value) {
              var kardex ={id,_token:'{{ csrf_token() }}'}
              axios.post('{{ route('borrarElementoKardex') }}',kardex).then(response=>{
                this.getKardex()
                swal('¡Hecho!','Se ha eliminado la asignatura del kardex.','success')
              }).catch(response=>{
                swal('¡Oops!','No se pudo completar la operación.','warning')
              })
            }
          })
        }
      }
    })

    var data = {}
    @foreach($estudiantes as $estudiante)
    data['{{$estudiante -> matricula}}'] = null;
    @endforeach

    $(document).ready(function() {
      $('#autocomplete-input').autocomplete({
        data: data,
        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
        onAutocomplete: function(val) {
          // Callback function when value is autcompleted.
        },
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
      });
      @if($matricula != 0)
        $('#autocomplete-input').val('{{$matricula}}');
        getData({{$matricula}})
      @endif
      $('#autocomplete-input').change(function(event) {
        //app.getEstudiante($('#autocomplete-input').val())
        getData($('#autocomplete-input').val())
      });
    })

    function getData(value){
      axios.get('{{ asset('/') }}admin/academicos/kardex/' + value).then(function(response) {
        app.estudiante = response.data
        app.$forceUpdate()
        app.getKardex()
      })
    }

    function saveKardex() {
      if (app.reticula.length) {
        var calificaciones = []
        msg = false
        for (i = 0; i < app.reticula.length; i++) {
          calificaciones[i] = {}
          if (!$('#calificacion_' + app.reticula[i].asignatura_id).val())
            msg = true
          calificaciones[i].estudiante_id = app.estudiante.estudiante_id
          calificaciones[i].asignatura_id = app.reticula[i].asignatura_id
          calificaciones[i].oportunidad_id = 4
          calificaciones[i].semestre = null
          calificaciones[i].periodo_id = $('#periodo_' + app.reticula[i].asignatura_id).val()
          calificaciones[i].calificacion = $('#calificacion_' + app.reticula[i].asignatura_id).val()
        }
        if (msg)
          alert('Faltan calificaciones por cargar.')
        else {
          axios.post('/controlescolar/admin/academicos/kardex', calificaciones).then(function(response) {
            alert(response.data)
          })
        }
      } else {
        alert('Seleccione un alumno para continuar.')
      }
    }
  </script>
@endsection
