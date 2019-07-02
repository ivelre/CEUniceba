<form id="form_estado_estudiante" novalidate="novalidate">
  <!-- Modal Structure -->
	<div id="modal_estado_estudiante" class="modal">
		<div class="modal-content">
			
			<h5>Nueva estado de estudiante</h5>
			<div class="divider"></div>
			<br>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">account_box</i>
					<input type="text" id="estado_estudiante" name="estado_estudiante" required="" aria-required="true">
					<label for="estado_estudiante">Estado</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">subject</i>
					<textarea id="descripcion" name="descripcion" class="materialize-textarea"></textarea>
          <label for="descripcion">Descripción</label>
				</div>
			</div>

		</div>

		<div class="modal-footer">
			<a class="waves-effect waves-light btn-flat modal-action modal-close" id="cancelar_estado_estudiante"><i class="material-icons left">close</i>cancelar</a>
			<button id="store_estado_estudiante" class="waves-effect waves-light btn-flat" type="submit" name="action">Guardar
		    <i class="material-icons left">save</i>
		  </button>
		</div>
		
	</div>
</form>