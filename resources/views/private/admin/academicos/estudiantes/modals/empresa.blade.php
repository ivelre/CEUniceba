<form id="form_empresa" novalidate="novalidate">
	<!-- Nuevo empresa -->
	<div id="modal_empresa" class="modal add">
		<div class="modal-content">
			
			<div class="row">
					<h4>Inserte el nombre de la empresa</h4>
					<div class="divider"></div>	
			</div>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">work</i>
					<input id="empresa" name="empresa" type="text" class="validate" required="" aria-required="true">
					<label for="empresa" >Empresa</label>
				</div>
			</div>

		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-ligth"><i class="material-icons left">close</i>Cerrar</a>
			<button id="store_empresa" class="btn-flat waves-effect waves-ligth"><i class="material-icons left">save</i>Guardar</button>
		</div>
	</div>
</form>