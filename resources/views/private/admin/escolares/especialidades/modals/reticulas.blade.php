<form id="form_reticula" novalidate="novalidate">
	<!-- Nueva especialidad -->
	<div id="modal_reticula" class="modal">
		<div class="modal-content">

			<div class="row">
				<div class="col s10 offset-s1">
					<h4 id="title_modal_reticula" >Agregar asignatura al periodo </h4>
					<div class="divider"></div>		
				</div>
			</div>
			
			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">list</i>
					<select id="select_asignaturas" name="select_asignaturas" class="validate" required="" aria-required="true">
					</select>
					<label for="select_asignaturas" class="active">Asignaturas</label>
				</div>
			</div>
			
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-ligth"><i class="material-icons left">close</i>Cancelar</a>
			<button id="store_reticula" class="btn-flat waves-effect waves-ligth"><i class="material-icons left">save</i>Guardar</button>
		</div>
	</div>
</form>