<form id="form_asignatura" novalidate="novalidate">
  <!-- Modal Structure -->
	<div id="modal_asignatura" class="modal">
		<div class="modal-content">
			
			<h5>Nueva asignatura</h5>
			<div class="divider"></div>
			<br>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">subject</i>
					<input type="text" id="asignatura" name="asignatura" required="" aria-required="true">
					<label for="asignatura">Asignatura</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">vpn_key</i>
					<input type="text" id="codigo" name="codigo" required="" aria-required="true">
					<label for="codigo">Código</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">exposure_plus_1</i>
					<input type="number" id="creditos" min="1" step="1" name="creditos" required="" aria-required="true" value="1">
					<label for="creditos">Créditos</label>
				</div>
			</div>	
		</div>
		<div class="modal-footer">
			<a class="waves-effect waves-light btn-flat modal-action modal-close" id="cancelar_asignatura"><i class="material-icons left">close</i>cancelar</a>
			<button id="store_asignatura" class="waves-effect waves-light btn-flat" type="submit" name="action">Guardar
		    <i class="material-icons left">save</i>
		  </button>

		</div>
	</div>
</form>