<form id="form_tipo_examen" novalidate="novalidate">
  <!-- Modal Structure -->
	<div id="modal_tipo_examen" class="modal">
		<div class="modal-content">
			
			<h5>Nueva tipo de examen</h5>
			<div class="divider"></div>
			<br>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">collections_bookmark</i>
					<input type="text" id="tipo_examen" name="tipo_examen" required="" aria-required="true">
					<label for="tipo_examen">Tipo</label>
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
			<a class="waves-effect waves-light btn-flat modal-action modal-close" id="cancelar_tipo_examen"><i class="material-icons left">close</i>cancelar</a>
			<button id="store_tipo_examen" class="waves-effect waves-light btn-flat" type="submit" name="action">Guardar
		    <i class="material-icons left">save</i>
		  </button>
		</div>
		
	</div>
</form>