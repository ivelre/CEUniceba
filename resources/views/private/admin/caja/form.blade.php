<div id="form" class="modal modal-fixed-footer full-modal" >
	<nav>
		<div class="nav-wrapper blue darken-2">
		</div>
	</nav>
  <div class="modal-content">
    <h4>Nuevo movimiento</h4>
    <div class="container white z-depth-3" style="padding: 3%;">
    	<div class="row">
				<div class="input-field col s12">
					<input id="nombre-autocomplete" type="text" class="validate autocomplete" v-model="newPago.nombre" autocomplete="off">
					<label for="nombre-autocomplete">Nombre</label>
				</div>
    	</div> <hr>
    	<div class="row">
    		<div class="input-field col s4">
					<input id="recibo_folio" type="text" class="validate" v-model="newPago.recibo_folio">
					<label for="recibo_folio">Recibo/folio</label>
    		</div>
    		<div class="input-field col s4">
					<input id="fecha_pago" type="date" class="validate" v-model="newPago.fecha_pago">
    		</div>
    		<div class="input-field col s4">
					<input id="cantidad" type="number" class="validate" min="1" v-model="newPago.cantidad">
					<label for="cantidad">Cantidad</label>
    		</div>
    		<div class="input-field col s4">
    			<div style="color: #9e9e9e">Concepto</div>
					<select id="concepto_id" v-model="newPago.concepto_id">
			      @foreach($conceptos as $concepto)
			      <option value="{{$concepto -> id }}">{{$concepto -> concepto }}</option>
			      @endforeach
			    </select>
    		</div>
    		<div class="input-field col s4">
    			<div style="color: #9e9e9e">Banco</div>
					<select id="banco_id" v-model="newPago.banco_id">
			      <option value="" disabled selected>Seleccione un banco</option>
			     	@foreach($bancos as $banco)
			      	<option value="{{$banco -> id }}">{{$banco -> descripcion }}</option>
			      @endforeach
			    </select>
    		</div>
    	</div>
    	<div class="row">
    		<div class="input-field col s4">
    			<div style="color: #9e9e9e">Mes inicio</div>
					<select id="mes_inicio" v-model="newPago.mes_inicio">
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
					<select id="mes_final" v-model="newPago.mes_final">
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
					<select id="anio" v-model="newPago.anio">
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
    	<a class="waves-effect waves-light btn blue darken-2" v-on:click="savePago"><i class="material-icons right">save</i>Guardar</a>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
    <a href="#!" class="waves-effect waves-green btn-flat " v-on:click="savePago">Guardar</a>
  </div>
</div>