<form id="form_oportunidad" novalidate="novalidate">
  <!-- Modal Structure -->
	<div id="modal_oportunidad" class="modal">
		<div class="modal-content">
			
			<h5>Nueva oportunidad</h5>
			<div class="divider"></div>
			<br>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">local_library</i>
					<input type="text" id="oportunidad" name="oportunidad" required="" aria-required="true">
					<label for="oportunidad">Oportunidad</label>
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
			<a class="waves-effect waves-light btn-flat modal-action modal-close" id="cancelar_oportunidad"><i class="material-icons left">close</i>cancelar</a>
			<button id="store_oportunidad" class="waves-effect waves-light btn-flat" type="submit" name="action">Guardar
		    <i class="material-icons left">save</i>
		  </button>
		</div>
		
	</div>
</form>