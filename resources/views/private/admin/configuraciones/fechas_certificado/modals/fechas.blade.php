<!-- Modal Structure -->
<div id="nueva_fecha" class="modal">
	<div class="modal-content">
		
		<h5>Nueva fecha certificdo</h5>
		<div class="divider"></div>
		<br>

		<div class="row">
			<div class="input-field col s12">
				<i class="material-icons prefix">calendar</i>
				<input type="date" id="fecha_certificado" name="fecha_certificado" required="" aria-required="true">
				<input type="hidden" id="id" name="id" required="" aria-required="true">
				{{-- <label for="fecha">Fecha</label> --}}
			</div>
		</div>

	</div>

	<div class="modal-footer">
		<a class="waves-effect waves-light btn-flat modal-action modal-close" id="cancelar_estado_estudiante"><i class="material-icons left">close</i>cancelar</a>
		<button  id="guardar_fecha_certificado" class="waves-effect waves-light btn-flat" name="action">Guardar
	    <i class="material-icons left">save</i>
	  </button>
	</div>
	
</div>