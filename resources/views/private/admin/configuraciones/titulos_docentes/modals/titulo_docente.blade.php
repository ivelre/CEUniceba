<form id="form_titulo_docente" novalidate="novalidate">
  <!-- Modal Structure -->
	<div id="modal_titulo_docente" class="modal">
		<div class="modal-content">
			
			<h5>Nueva título de docente</h5>
			<div class="divider"></div>
			<br>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">class</i>
					<input type="text" id="titulo" name="titulo" required="" aria-required="true">
					<label for="titulo">Título</label>
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
			<a class="waves-effect waves-light btn-flat modal-action modal-close" id="cancelar_titulo_docente"><i class="material-icons left">close</i>cancelar</a>
			<button id="store_titulo_docente" class="waves-effect waves-light btn-flat" type="submit" name="action">Guardar
		    <i class="material-icons left">save</i>
		  </button>
		</div>
		
	</div>
</form>