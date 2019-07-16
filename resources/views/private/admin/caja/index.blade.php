@extends('private.admin.caja.layouts.scaffold')

@section('title')Caja @stop

@section('content')
<h1>Caja</h1>
<hr>

<div class="row">
	<div class="col s4" style="margin-top: 2%;">
		<a class="waves-effect waves-light btn blue darken-2 modal-trigger" href="#form"><i class="material-icons right">send</i>Nuevo movimiento</a>
	</div>
	<div class="input-field col s8">
		<input id="nombre" type="text" class="validate autocomplete" autocomplete="off">
		<label for="nombre">Nombre</label>
	</div>
</div>
<div id="v-app">
  <ul class="collapsible" data-collapsible="accordion">
    <li v-for="movimiento in historial">
      <div class="collapsible-header"><i class="material-icons">view_headline</i>@{{movimiento.matricula}} - @{{movimiento.nombre}} - @{{movimiento.concepto}} - @{{moneyFormat(movimiento.cantidad)}}</div>
      <div class="collapsible-body">
        <div class="row">
          <div class="col s8">
          	@{{movimiento.matricula}} - @{{movimiento.nombre}} <br>
            @{{movimiento.estado_estudiante}} - @{{movimiento.especialidad}}
          </div>
          <div class="col s4 right-align">
            <a class="btn-floating btn-small waves-effect waves-light green" v-on:click="editarPago(movimiento)"><i class="material-icons">edit</i></a>
            <a class="btn-floating btn-small waves-effect waves-light red" v-on:click="deletePago(movimiento.id)"><i class="material-icons">delete</i></a>
          </div>
        </div>
        <hr>
      	<div class="row">
      		<div class="col s4"><strong>Recibo/folio:</strong> @{{movimiento.recibo_folio}}</div>
      		<div class="col s4"><strong>Concepto:</strong> @{{movimiento.concepto}}</div>
      		<div class="col s4"><strong>Cantidad:</strong>@{{moneyFormat(movimiento.cantidad)}}</div>
      		<div class="col s4"><strong>Fecha:</strong> @{{movimiento.fecha_pago}}</div>
          <div class="col s4"><strong>Cuenta bancaria:</strong> @{{movimiento.cuenta_bancaria}}</div>
          <div class="col s4" v-if="movimiento.cubre != '0-0-0'"><strong>Cubre:</strong> @{{movimiento.cubre}}</div>
      	</div>
      </div>
    </li>
    {{-- <li>
      <div class="collapsible-header tooltipped" data-position="left" data-delay="50" data-tooltip="MOVIMIENTO"><i class="material-icons">view_headline</i>00000 - NOMBRE DEL ALUMNO - $0,000.00</div>
      <div class="collapsible-body">
      	
      </div>
    </li> --}}
  </ul>
  @include('private.admin.caja.form')

  <ul class="pagination">
    <li :class="getStatusMove(1)" v-on:click="nextPage()"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
    <li :class="getActive(n)" v-for="n in pages" v-on:click="showPage(n)" v-if="show(n)"><a href="#!">@{{ n }}</a></li>
    <li :class="getStatusMove(2)" v-on:click="prevPage()"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
  </ul>
</div>

@stop

@section('script')
<script type="text/javascript">
  var app = new Vue({
      created: function () {
        this.getHistorial('-')
        this.getEstudiantes()
      },
      el: '#v-app',
      data: {
        historial: {},
        estudiantes:{},
        newPago:{},
        page:1,
        pages:0,
        busqueda:'-',
        renderPages:[1,2,3,4,5,6,'...',426,427,428,429,430,431]
      },
      methods:{
        getHistorial:function(){
          axios.get('get/pagos/estudiantes/' + this.page + '/' + this.busqueda).then(response=>{
            this.historial = response.data
            this.pages = Math.floor(this.historial[0].totalRegistros)
          }).catch(response=>{
            console.log(response);
          })
        },
        editarPago:function(pago){
          this.newPago = pago
          this.newPago.nombre = pago.matricula + ' - ' + pago.nombre
          $('#form').modal('open');
        },
        showPage:function(n){
          if(n != this.page && n != '...'){
            this.page = n
            this.getHistorial();
          }
        },
        show:function(n){
          if(n <= 10 || n > this.pages - 10)
            return true
          return false
        },
        getActive:function(n){
          if(n == '...')
            return 'disabled'
          if(n == this.page)
            return 'active'
          return 'waves-effect'
        },
        nextPage:function(){
          if(this.page > 1){
            this.page--
            this.getHistorial()
          }
        },
        prevPage:function(){
         if(this.page < this.pages){
            this.page++
            this.getHistorial()
         }
        },
        getStatusMove:function(dir){
          if(dir == 1 && this.page == 1){
            return 'disabled'
          }
          if(dir == 2 && this.page == this.pages)
            return 'disabled'
          else
            return 'waves-effect'
        },
        getEstudiantes:function(){
          axios.get('{{ route('getEstudiantes') }}').then(response=>{
            this.estudiantes = response.data.estudiantes
            $('#nombre-autocomplete').autocomplete({
              data: response.data.dataNombre,
              limit: 20,
              onAutocomplete: function(val) {
                app.newPago.nombre = val
              },
              minLength: 1,
            });$('#nombre').autocomplete({
              data: response.data.dataNombre,
              limit: 20,
              onAutocomplete: function(val) {
                app.busqueda = val
                app.getHistorial()
              },
              minLength: 1,
            });
          }).catch(response=>{
            // swal('¡Oops!','No se pudo completar la operación.','warning')
          })
        },
        moneyFormat:function(num){
          return '$' + Number(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        },
        savePago:function(){
          this.newPago.concepto_id = $('#concepto_id').val()
          this.newPago.banco_id = $('#banco_id').val()
          this.newPago.mes_inicio = $('#mes_inicio').val()
          this.newPago.mes_final = $('#mes_final').val()
          this.newPago.anio = $('#anio').val()
          this.newPago._token = "{{csrf_token()}}"
          if(this.newPago.nombre == ''      ||  this.newPago.nombre === undefined       ||
            this.newPago.fecha_pago == ''   ||  this.newPago.fecha_pago === undefined   ||
            this.newPago.concepto_id == ''  ||  this.newPago.concepto_id === undefined  ||
            this.newPago.cantidad == ''     ||  this.newPago.cantidad === undefined     ||
            this.newPago.banco_id == ''     ||  this.newPago.banco_id === undefined
            )
            Swal.fire('¡Atención!','Faltan datos por llenar.','warning')
          else{
            // console.log(this.newPago);
            axios.post('{{ route('nuevoPago') }}',this.newPago).then(response=>{
              this.getHistorial()
              Materialize.toast('Pago cargado', 5000)
              this.newPago.nombre = ''
              this.newPago.fecha_pago = ''
              this.newPago.cantidad = ''
              this.newPago.recibo_folio = ''
              this.newPago.concepto_id = 0
              this.newPago.mes_inicio = 0
              this.newPago.mes_final = 0
              this.newPago.anio = 0
              $('#form').modal('close');
            }).catch(response=>{
              Swal.fire('¡Oops!','No se pudo completar la el pago.','error')
            })
          }
        },
        deletePago:function(pago_id){
          Swal.fire({
            title: '¡Atención!',
            text: "¿Desea continuar con la siguiente operación?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar'
          }).then((result) => {
            if (result.value) {
              axios.delete('{{ asset('/') }}admin/delete/pago/estudiante/' + pago_id,{_token:"{{csrf_token()}}"}).then(response=>{
                this.getHistorial()
                Materialize.toast('Pago eliminado', 5000)
            
                $('#form').modal('close');
              }).catch(response=>{
                Swal.fire('¡Oops!','No se pudo completar la el pago.','error')
              })
            }
          })
        }
      }
    })

  $('#nombre').focusout(function(event) {
    if($('#nombre').val() == ''){
      app.busqueda = '-'
      app.getHistorial()
    }
  });
	$('.collapsible').collapsible();
	// $('select').material_select();
  $('.modal').modal();
</script>
@stop