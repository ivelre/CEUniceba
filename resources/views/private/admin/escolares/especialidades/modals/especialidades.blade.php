<form id="form_especialidad" novalidate="novalidate">
	<!-- Nueva especialidad -->
	<div id="modal_especialidad" class="modal modal-fixed-footer add">
		<div class="modal-content">
			
			<h4>Nueva especialidad</h4>
			<div class="row">
			<br>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">school</i>
					<select id="nivel_academico_id" name="nivel_academico_id" class="validate" required="" aria-required="true"> 
						@foreach($niveles_academicos as $nivele_academico)
						<option value="{{ $nivele_academico -> id }}">{{ $nivele_academico -> nivel_academico }}</option>
						@endforeach
					</select>
					<label for="nivel_academico_id">Nivel Académico</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">account_balance</i>
					<input id="especialidad" name="especialidad" type="text" class="validate" required="" aria-required="true">
					<label for="especialidad">Especialidad</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">vpn_key</i>
					<input id="clave" name="clave" type="text" class="validate" required="" aria-required="true">
					<label for="clave">Código</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">mode_comment</i>
					<input type="text" class="validate" id="descripcion">
					<label>Descripción</label>
				</div>
			</div>
			
			<br>
			<div class="divider"></div>
			<br>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">list</i>
					<select id="modalidad_id" name="modalidad_id" class="validate" required="" aria-required="true">
						@foreach($modalidades_especialidades as $modalidad_especialidad)
							<option value="{{ $modalidad_especialidad -> id }}">{{ $modalidad_especialidad -> modalidad_especialidad }}</option>
						@endforeach
					</select>
					<label for="modalidad_id" >Modalidad</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">list</i>
					<select id="tipo_plan_especialidad_id" name="tipo_plan_especialidad_id" class="validate" required="" aria-required="true">
						@foreach($tipos_planes_especialidades as $tipo_plan_especialidad)
							<option value="{{ $tipo_plan_especialidad -> id }}">{{ $tipo_plan_especialidad -> tipo_plan_especialidad }}</option>
						@endforeach
					</select>
					<label for="tipo_plan_especialidad_id">Tipo de plan</label>
				</div>
			</div>

			<br>
			<div class="divider"></div>
			<br>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">verified_user</i>
					<input id="reconocimiento_oficial" name="reconocimiento_oficial" type="text" class="validate" required="" aria-required="true">
					<label for="reconocimiento_oficial">Reconocimiento oficial</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">date_range</i>
					<input id="fecha_reconocimiento" name="fecha_reconocimiento" type="text" class="datepicker" class="validate" required="" aria-required="true">
					<label for="fecha_reconocimiento">Fecha de reconocimiento oficial</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">vpn_key</i>
					<input id="dges" name="dges" type="text" class="validate">
					<label for="dges">DGES</label>
				</div>
			</div>

		</div>

		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-ligth"><i class="material-icons left">close</i>Cancelar</a>
			<button id="store_especialidad" class="btn-flat waves-effect waves-ligth"><i class="material-icons left">save</i>Guardar</button>

		</div>
	</div>
</form>