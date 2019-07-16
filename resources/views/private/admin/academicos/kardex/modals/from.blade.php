<!-- Nuevo empresa -->
<div id="modal_kardex" class="modal add full-modal" >
	<div class="modal-content">
		
		<div class="row">
				<h4>Materia de kardex</h4>
				<div class="divider"></div>	
		</div>

		<div class="row">

				<div class="input-field col s5 offset-s1">
					<i class="material-icons prefix">work</i>
					<input type="text" id="asignatura_text" class="autocomplete">
					{{-- <select id="asignatura_id">
		        <option v-for="materia in reticula" :value="materia.id">@{{ materia.asignatura }}</option>
		      </select> --}}
					<label>Asignaturas</label>
				</div>
				<div class="input-field col s5">
					<i class="material-icons prefix">work</i>
					<input type="text" id="clase_text" class="autocomplete">
					{{-- <select id="asignatura_id">
		        <option v-for="materia in reticula" :value="materia.id">@{{ materia.asignatura }}</option>
		      </select> --}}
					<label>Grupos</label>
				</div>

				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">work</i>
					<input id="calificacion" name="calificacion" type="number" min="0" max="10" class="validate" required="" aria-required="true" :value="5">
					<label for="calificacion" >Calificación</label>
				</div>

				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">work</i>
					<select id="oportunidad_id">
	          @foreach ($oportunidades as $oportunidad)
	            <option value="{{$oportunidad -> id}}">{{$oportunidad -> oportunidad}}</option>
	          @endforeach
	        </select>
					<label>Oportunidad</label>
				</div>

				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">work</i>
					<input id="semestre" name="semestre" type="number" min="1" max="10" class="validate" required="" aria-required="true" :value="5">
					<label for="semestre" >Semestre</label>
				</div>

				<div class="input-field col s10 offset-s1">
					<i class="material-icons prefix">work</i>
					<select id="periodo_id">
	          @foreach ($periodos as $periodo)
	            <option value="{{$periodo -> id}}">{{$periodo -> periodo}}</option>
	          @endforeach
	        </select>
					<label>Periodo</label>
				</div>

				<input id="id" name="id" type="hidden" value="">

		</div>

	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-ligth"><i class="material-icons left">close</i>Cerrar</a>
		<button v-on:click="saveMateria()" id="store_empresa" class="btn-flat waves-effect waves-ligth"><i class="material-icons left">save</i>Guardar</button>
	</div>
</div>