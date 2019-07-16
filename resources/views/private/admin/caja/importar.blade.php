@extends('private.admin.caja.layouts.scaffold')

@section('title')Importar @stop

@section('content')
<h1>Importar transferencia</h1>
<hr>

<div class="file-field input-field">
	<div class="btn blue darken-2">
		<span>Cargar</span>
		<input type="file" id="file" accept=".txt,.csv">
	</div>
	<div class="file-path-wrapper">
		<input id="text_file" class="file-path validate" type="text">
	</div>
</div>

<div id="v-app">
	<ul class="collapsible" data-collapsible="accordion">
		<li v-if="importer.length === 0 && !loader ">
	    <div class="collapsible-header"><i class="material-icons orange-text">warning</i>No sé ha importado ningún archivo</div>
	    <div class="collapsible-body"><span>Favor intente importar un archivo desde el botón de cargar.</span></div>
	  </li>
	  <li v-for="line in importer">
		    <div class="collapsible-header"><i :class="'material-icons ' + getColorIcon(line.icon) ">@{{line.icon}}</i>
		    	@{{line.matricula}} - @{{line.nombre}} - @{{moneyFormat(line.cantidad)}}
		    </div>
		    <div class="collapsible-body">
		    	<small class="amber-text">@{{line.message}}</small> 
		    	<hr>
		    	<small>@{{line.original}}</small>
		    	<hr>
		    	<div class="row">
		        <div class="input-field col s4">
		          <input id="matricula" type="text" class="validate" v-model="line.matricula">
		          <label for="matricula" class="active">Matrícula</label>
		        </div>
		        <div class="input-field col s8">
		          <input id="nombre" type="text" class="validate" v-model="line.nombre" disabled>
		          <label for="nombre" class="active">Nombre</label>
		        </div>
		      </div>
		    	<div class="row">
		        <div class="input-field col s4">
		          <input id="factura" type="text" class="validate" v-model="line.factura">
		          <label for="factura" class="active">Factura</label>
		        </div>
		        <div class="input-field col s4">
		        	<div style="color: #9e9e9e">Concepto</div>
		          <select style="padding: 1px" id="concepto" v-model="line.concepto_id">
					      @foreach($conceptos as $concepto)
					      <option value="{{$concepto -> id }}">{{$concepto -> concepto }}</option>
					      @endforeach
					    </select>
		        </div>
		        <div class="input-field col s4">
		          <input id="cantidad" type="text" class="validate" v-model="line.cantidad">
		          <label for="cantidad" class="active">Cantidad</label>
		        </div>
		      </div>
		    	<div class="row">
		        <div class="input-field col s4">
		          <input id="fecha_pago" type="date" class="validate datepicker" v-model="line.fecha_pago">
		          <label for="fecha_pago" class="active">Fecha</label>
		        </div>
		        <div class="input-field col s4">
		        	<div style="color: #9e9e9e">Banco</div>
		          <select style="padding: 1px" id="banco" v-model="line.banco_id">
					      <option value="" disabled>Seleccione un banco</option>
					      @foreach($bancos as $banco)
					      <option value="{{$banco -> id }}">{{$banco -> descripcion }}</option>
					      @endforeach
					    </select>
		        </div>
		      </div>
				   <div class="row">
		    		<div class="input-field col s4">
		    			<div style="color: #9e9e9e">Mes inicio</div>
							<select id="mes_inicio" v-model="line.mes_inicio">
					      <option value="Ene">Enero</option>
					      <option value="Feb">Febrero</option>
					      <option value="Mar">Marzo</option>
					      <option value="Abr">Abril</option>
					      <option value="May">Mayo</option>
					      <option value="Jun">Junio</option>
					      <option value="Jul">Julio</option>
					      <option value="Ago">Agosto</option>
					      <option value="Sep">Septiembre</option>
					      <option value="Oct">Octubre</option>
					      <option value="Nov">Noviembre</option>
					      <option value="Dic">Diciembre</option>
					    </select>
		    		</div>
		    		<div class="input-field col s4">
		    			<div style="color: #9e9e9e">Mes final</div>
							<select id="mes_final" v-model="line.mes_final">
					      <option value="Ene">Enero</option>
					      <option value="Feb">Febrero</option>
					      <option value="Mar">Marzo</option>
					      <option value="Abr">Abril</option>
					      <option value="May">Mayo</option>
					      <option value="Jun">Junio</option>
					      <option value="Jul">Julio</option>
					      <option value="Ago">Agosto</option>
					      <option value="Sep">Septiembre</option>
					      <option value="Oct">Octubre</option>
					      <option value="Nov">Noviembre</option>
					      <option value="Dic">Diciembre</option>
					    </select>
		    		</div>
		    		<div class="input-field col s4">
		    			<div style="color: #9e9e9e">Año</div>
							<select id="anio" v-model="line.anio">
					      <option value="19">2019</option>
					      <option value="20">2020</option>
					      <option value="21">2021</option>
					      <option value="22">2022</option>
					      <option value="23">2023</option>
					      <option value="24">2024</option>
					      <option value="25">2025</option>
					      <option value="26">2026</option>
					      <option value="27">2027</option>
					      <option value="28">2028</option>
					      <option value="29">2029</option>
					      <option value="30">2030</option>
					    </select>
		    		</div>
		    	</div>
		      <div class="center-align">
				    <p><strong>Últimos pagos</strong></p>
				    <div v-for='pago in line.pagos'>
				    	<label>@{{ pago.concepto }} - @{{ pago.cantidad }} - @{{ pago.fecha_pago }} - @{{ pago.mes_inicio }}/@{{ pago.mes_final }}/@{{ pago.anio }}</label><br>
				    </div>
				   </div>
		    </div>
	  </li>
	</ul>
	<div class="row center-align" v-if="loader">
		<div class="preloader-wrapper big active">
		  <div class="spinner-layer spinner-blue-only">
		    <div class="circle-clipper left">
		      <div class="circle"></div>
		    </div><div class="gap-patch">
		      <div class="circle"></div>
		    </div><div class="circle-clipper right">
		      <div class="circle"></div>
		    </div>
		  </div>
		</div>
	</div>

	<a class="waves-effect waves-light btn blue darken-2" v-on:click="setPagos()"><i class="material-icons right">send</i>Continuar</a>
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
        importer: [],
        loader:false
      },
      methods:{
        moneyFormat:function(num){
  				return '$' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        },
        getColorIcon:function(icon){
  				switch(icon) {
  					case 'done':return 'green-text darken-2'; break;
  					case 'warning':return 'orange-text'; break;
  				}
        },setPagos:function(){
        	if(this.importer.length == 0){
        		Swal.fire(
								  '¡Atención!',
								  'Seleccione un archivo para continuar.',
								  'warning'
								)
        	}else{
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
			        	var nuevosPagos = {}
			          nuevosPagos._token = '{{ csrf_token() }}'
			          nuevosPagos.pagos = this.importer
			          axios.post('{{ route('nuevosPagos') }}',nuevosPagos).then(response=>{
			            this.importer = []
			            $("#text_file").val('');
			            Swal.fire(
									  '¡Listo!',
									  'Se han cargado los registros.',
									  'success'
									)
			          }).catch(response=>{
			            console.log(response);
			          })
						  }
						})
					}
        }
      }
    })

	var importer = null
	$('.collapsible').collapsible();

	$("#file").change(function(){
		app.loader = true
		var formData = new FormData();
		var imagefile = document.querySelector('#file');
		formData.append("file", imagefile.files[0]);
		formData.append("_token", '{{ csrf_token() }}');
		axios.post('{{ asset('/') }}admin/set/archivo', formData, {
			headers: {
				'Content-Type': 'multipart/form-data'
			}
		}).then(function (data) {
					importer = data.data
					app.importer = importer
					app.loader = false
					// setTimeout(function(){ $('select').material_select(); }, 1000);
        })
        .catch(function () {
          console.log('FAILURE!!');
        });
	});

</script>
@stop