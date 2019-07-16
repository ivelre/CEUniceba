@extends('private.admin.caja.layouts.scaffold')

@section('title')Reportes @stop

@section('content')
<h1>Reportes</h1>
<hr>


<div id="v-app">
	<h5>Por especialidades</h5>
	<hr>
	<div class="row">

		<div class="col s3">
	    <input name="group1" type="radio" id="todos" value="0" v-model="reporte.tipo_reporte">
	    <label for="todos">Todos</label>
	  </div>

		<div class="col s3">
	    <input name="group1" type="radio" id="licenciaturas" value="1" v-model="reporte.tipo_reporte">
	    <label for="licenciaturas">Licenciaturas</label>
	  </div>

		<div class="col s3">
	    <input name="group1" type="radio" id="maestrias" value="2" v-model="reporte.tipo_reporte">
	    <label for="maestrias">Maestrias</label>
	  </div>

		<div class="col s3">
	    <input name="group1" type="radio" id="doctorados" value="3" v-model="reporte.tipo_reporte">
	    <label for="doctorados">Doctorados</label>
	  </div>

		<div class="col s4">
			<br>
	    <input name="group1" type="radio" id="especialidad" value="4" v-model="reporte.tipo_reporte">
	    <label for="especialidad">Especialidad</label>
	    <div class="input-field col s12">
				<select id="banco_id" v-model="reporte.especialidad">
		      <option value="0" disabled selected>Seleccione una especialidad</option>
		     	@foreach($especialidades as $especialidad)
		      	<option value="{{$especialidad -> id }}">{{$especialidad -> nivel_academico }} en {{$especialidad -> especialidad }} ({{$especialidad -> plan_especialidad }})</option>
		      @endforeach
		    </select>
  		</div>
	  </div>

	  <div class="input-field col s4">
	  	<div style="color: #9e9e9e">De</div>
			<input type="date" class="validate" v-model="reporte.fecha_pago_inicio" style="padding-top: 10px;">
		</div>

		<div class="input-field col s4">
			<div style="color: #9e9e9e">Hasta</div>
			<input type="date" class="validate" v-model="reporte.fecha_pago_final" style="padding-top: 10px;">
		</div>

		<a class="waves-effect waves-light btn blue darken-2" v-on:click="verReporte()"><i class="material-icons right">visibility</i>Ver Reporte</a>

   </div>

	<h5>Por bancos (Pólizas)</h5>
	<hr>
	<div class="row">
		<div class="input-field col s4">
			<div style="color: #9e9e9e">Banco</div>
			<select id="banco_id" v-model="reporteBanco.banco_id" style="padding-top: 30px;">
	      <option value="" disabled selected>Seleccione un banco</option>
	     	@foreach($bancos as $banco)
	      	<option value="{{$banco -> id }}">{{$banco -> descripcion }}</option>
	      @endforeach
	    </select>
		</div>

		<div class="input-field col s4">
	  	<div style="color: #9e9e9e">De</div>
			<input type="date" class="validate" v-model="reporteBanco.fecha_pago_inicio" style="padding-top: 10px;">
		</div>

		<div class="input-field col s4">
			<div style="color: #9e9e9e">Hasta</div>
			<input type="date" class="validate" v-model="reporteBanco.fecha_pago_final" style="padding-top: 10px;">
		</div>

		<a class="waves-effect waves-light btn blue darken-2" v-on:click="verReporteBanco()"><i class="material-icons right">visibility</i>Ver Reporte</a>
	</div>
	<br>
	<br>
	<br>
</div>

@stop

@section('script')
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script type="text/javascript">

	var app = new Vue({
      el: '#v-app',
      data: {
        reporte: {tipo_reporte:0,especialidad:0},
        reporteBanco:{banco_id:9}
      },
      methods:{
      	verReporte:function(){
      		if(this.reporte.fecha_pago_inicio === undefined || this.reporte.fecha_pago_final === undefined){
      			Swal.fire('Favor de seleccionar una fecha')
      		}else{
	      		window.open('{{ asset('/') }}admin/pdf/caja/reportes/ingresos/' + this.reporte.tipo_reporte + '/' + this.reporte.especialidad + '/' + this.reporte.fecha_pago_inicio + '/' + this.reporte.fecha_pago_final, '_blank');
	      	}
			  },
      	verReporteBanco:function(){
      		if(this.reporteBanco.fecha_pago_inicio === undefined || this.reporteBanco.fecha_pago_final === undefined){
      			Swal.fire('Favor de seleccionar una fecha')
      		}else{
	      		window.open('{{ asset('/') }}admin/pdf/caja/reportes/poliza/' + this.reporteBanco.banco_id + '/' + this.reporteBanco.fecha_pago_inicio + '/' + this.reporteBanco.fecha_pago_final, '_blank');
	      	}
			  }
			}
    })

</script>
@stop