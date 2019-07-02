<form id="form_instituto" novalidate="novalidate">
	<!-- Nuevo instituto -->
	<div id="modal_instituto" class="modal modal-fixed-footer add">
		<div class="modal-content">
			
			<div class="row">
					<h4>Inserte el nombre del instituto</h4>
					<div class="divider"></div>	
			</div>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">school</i>
					<input id="instituto" name="instituto" type="text" class="validate" required="" aria-required="true">
					<label for="instituto" >Instituto</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">broken_image</i>
					<select id="instituto_estado_id" name="institucion_estado_id">
						@foreach($estados as $estado)
							<option value="{{ $estado->id }}" 
								@if($estado->id == 11) 
									selected 
								@endif >{{ $estado->estado }}
							</option>	
						@endforeach
					</select>
					<label for="institucion_estado_id">Estado</label>
				</div>	
			</div>

			<div class="row">
				<div class="input-field col s10 offset-s1" style="margin-bottom: 16px;">
					<i class="material-icons prefix">location_city</i>
					<select id="instituto_municipio_id" name="instituto_municipio_id">			
						@foreach($municipios as $municipio)
							<option value="{{ $municipio->id }}" 
								@if($municipio->id == 327) 
									selected 
								@endif >{{ $municipio->municipio }}
							</option>	
						@endforeach
					</select>
					<label class="active" for="instituto_municipio_id">Municipio</label>
				</div>	
			</div>

		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-ligth"><i class="material-icons left">close</i>Cerrar</a>
			<button id="store_instituto" class="btn-flat waves-effect waves-ligth"><i class="material-icons left">save</i>Guardar</button>
		</div>
	</div>
</form>