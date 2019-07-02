<form id="form_requisito" novalidate="novalidate">
	<!-- Nueva especialidad -->
	<div id="modal_requisito" class="modal modal-fixed-footer add">
		<div class="modal-content">

			<div class="row">
					<h4 id="title_modal_requisito" >Requisitos para </h4>
					<div class="divider"></div>	
			</div>
			

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">list</i>
					<select id="select_requisitos" name="select_requisitos" class="validate" required="" aria-required="true">
					</select>
					<label for="select_requisitos" class="active">Asignaturas</label>
				</div>
			</div>
			
			<div class="row">
				<div id="requisitos_reticula" class="col s12">
				</div>
			</div>

		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-ligth"><i class="material-icons left">close</i>Cerrar</a>
			<button id="store_reticula" class="btn-flat waves-effect waves-ligth"><i class="material-icons left">save</i>Guardar</button>
		</div>
	</div>
</form>