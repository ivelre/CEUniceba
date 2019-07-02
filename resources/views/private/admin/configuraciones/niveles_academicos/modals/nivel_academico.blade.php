<form id="form_nivel_academico" novalidate="novalidate">
  <!-- Modal Structure -->
	<div id="modal_nivel_academico" class="modal">
		<div class="modal-content">
			
			<h5>Nuevo nivel académico.</h5>
			<div class="divider"></div>
			<br>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">account_balance</i>
					<input type="text" id="nivel_academico" name="nivel_academico" required="" aria-required="true">
					<label for="nivel_academico">Nivel académico</label>
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
			<a class="waves-effect waves-light btn-flat modal-action modal-close" id="cancelar_nivel_academico"><i class="material-icons left">close</i>cancelar</a>
			<button id="store_nivel_academico" class="waves-effect waves-light btn-flat" type="submit" name="action">Guardar
		    <i class="material-icons left">save</i>
		  </button>
		</div>
		
	</div>
</form>