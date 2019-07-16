<div class="section">
	<h5>Clase</h5>
	<p>Datos de la clase</p>
	<div class="divider"></div>
</div>

<div class="row">
	
	<div class="input-field col s12">
		<i class="material-icons prefix">class</i>
		<input id="clase" name="clase" type="text" class="validate
		@if( $errors->has('clase')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('clase')){{ old('clase') }}@elseif(isset($clase)){{ $clase->clase}}@endif" >
		<label for="clase"
		@if( $errors->has('clase')) 
			class="active"
			data-error=" {{ $errors->first('clase',':message') }} "  
		@endif>*Clase</label>
	</div>
	
	<div class="input-field col s12">
		<i class="material-icons prefix">class</i>
		<input id="turno" name="turno" type="text" class="validate
		@if( $errors->has('clase')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('clase')){{ old('clase') }}@elseif(isset($clase)){{ $clase->turno }}@endif" >
		<label for="turno"
		@if( $errors->has('clase')) 
			class="active"
			data-error=" {{ $errors->first('clase',':message') }} "  
		@endif>*Turno</label>
	</div>
	
	<div class="input-field col s12" style="margin-bottom: 20px;">
		<i class="material-icons prefix">school</i>
		<select id="asignatura_id" name="asignatura_id" class="validate
		@if( $errors->has('asignatura_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($asignaturas as $asignatura)
				@if(old('asignatura_id'))
					<option value="{{ $asignatura->id }}" 
						@if($asignatura->id == old('asignatura_id')) 
							selected 
						@endif >{{ $asignatura->asignatura }}</option>	
				@elseif(isset($clase))
					<option value="{{ $asignatura->id }}" 
						@if($asignatura->id == $clase->asignatura_id)
							selected 
						@endif >{{ $asignatura->asignatura }}</option>	
				@else
					<option value="{{ $asignatura->id }}" 
						@if($asignatura->id == 1) 
							selected 
						@endif >{{ $asignatura->asignatura }}</option>	
				@endif
			@endforeach
		</select>
		<label for="asignatura_id" class="active"
		@if( $errors->has('asignatura_id')) 
			data-error=" {{ $errors->first('asignatura_id',':message') }} "  
		@endif>*Asignatura</label>
	</div>
	
	<div class="input-field col s12" style="margin-bottom: 20px;">
		<input id="docente" name="docente" type="hidden" value="1">
		<i class="material-icons prefix">account_box</i>
		<select id="docente_id" name="docente_id" class="validate
		@if( $errors->has('docente_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($docentes as $docente)
				@if(old('docente_id'))
					<option value="{{ $docente->id }}" 
						@if($docente->id == old('docente_id')) 
							selected 
						@endif >{{ 
							$docente->dato_general->nombre.' '.
							$docente->dato_general->apaterno.' '.
							$docente->dato_general->amaterno
						 }}</option>	
				@elseif(isset($clase))
					<option value="{{ $docente->id }}" 
						@if($docente->id == $clase->docente_id)
							selected 
						@endif >{{
							$docente->dato_general->nombre.' '.
							$docente->dato_general->apaterno.' '.
							$docente->dato_general->amaterno
						}}</option>	
				@else
					<option value="{{ $docente->id }}" 
						@if($docente->id == 1) 
							selected 
						@endif >{{
							$docente->dato_general->nombre.' '.
							$docente->dato_general->apaterno.' '.
							$docente->dato_general->amaterno
						}}</option>	
				@endif
			@endforeach
		</select>
		<label for="docente_id" class="active"
		@if( $errors->has('docente_id') ) 
			data-error=" {{ $errors->first('docente_id',':message') }} "
		@endif>*Docente</label>
	</div>
	@if( $errors->has('docente') ) 
		<div class="chip red darken-4 white-text">
	    {{$errors->first('docente',':message')}}
	    <i class="close material-icons white-text">close</i>
	  </div>
	@endif
</div>

<div class="row">
	<h5>Horario</h5>
	<p>Horario de la clase</p>
	<div class="divider"></div>
</div>

@if( $errors->has('dia') ) 
	
		<div class="chip red darken-4 white-text">
	    Necesita agregar un horario
	    <i class="close material-icons white-text">close</i>
	  </div>
	
@endif

@if( $errors->has('hora_entrada.*') ) 
	
		<div class="chip red darken-4 white-text">
	    Hora de inicio incompleta
	    <i class="close material-icons white-text">close</i>
	  </div>
	
@endif

@if( $errors->has('hora_salida.*') ) 
	
		<div class="chip red darken-4 white-text">
	    Hora de salida incompleta o menor que el horario de inicio 
	    <i class="close material-icons white-text">close</i>
	  </div>
	
@endif

@foreach($dias as $dia)
	<div class="row valign-wrapper">
		<div class="col s12 m2 l2">
	    <input type="checkbox" class="filled-in" id="dia_{{ $loop->index }}" name="dia[]" value="{{ $loop->index }}" index="{{ $loop->index }}"
	    @if (isset($horarios))
	    	@foreach ($horarios as $horario)
	    		@if ($horario->dia_id == $dia->id)
	    			checked="checked"
	    		@endif
	    	@endforeach
	    @else
	    	@if ($errors->has('hora_entrada.'.$loop->index) || $errors->has('hora_salida.'.$loop->index) || old('hora_entrada.'.$loop->index) )
	    		checked="checked"
	    	@endif
	    @endif/>
	    <label for="dia_{{ $loop->index }}"/>{{ $dia->dia }}</label>
		</div>

		<div class="col s12 m5">
			<input id="hora_entrada_{{ $loop->index }}" name="hora_entrada[{{ $loop->index }}]" type="text" class="timepicker
			@if( $errors->has('hora_entrada.'.$loop->index) ) 
				invalid
			@endif"
			@if (isset($horarios))
			{{ $match=false }}
				@foreach ($horarios as $horario)
	    		@if ($horario->dia_id == $dia->id)
	    			{{ $match=true }}
	    			value="{{ date("H:i", strtotime($horario->hora_entrada)) }}" 
	    		@endif
	    	@endforeach
	    	@if (!$match)
	    		disabled="true"
	    	@endif
			@else
				@if( $errors->has('hora_entrada.'.$loop->index) || old('hora_entrada.'.$loop->index) )
					value="{{ old('hora_entrada.'.$loop->index) }}" 
				@else
					disabled="true"
				@endif
			@endif required="" aria-required="true"/>
			<label for="hora_entrada[{{ $loop->index }}]"
			@if( $errors->has('hora_entrada.'.$loop->index)) 
				class="active"
			@endif></label>
		</div>

		<div class="col s12 m5">
			<input id="hora_salida_{{ $loop->index }}" name="hora_salida[{{ $loop->index }}]" type="text" class="timepicker
			@if( $errors->has('hora_salida.'.$loop->index) ) 
				invalid
			@endif"
			@if (isset($horarios))
				{{ $match=false }}
				@foreach ($horarios as $horario)
	    		@if ($horario->dia_id == $dia->id)
	    			{{ $match=true }}
	    			value="{{ date("H:i", strtotime($horario->hora_salida)) }}" 
	    		@endif
	    	@endforeach
	    	@if (!$match)
	    		disabled="true"
	    	@endif
			@else
				@if( $errors->has('hora_salida.'.$loop->index) || old('hora_salida.'.$loop->index) )
					value="{{ old('hora_salida.'.$loop->index) }}" 
				@else
					disabled="true"
				@endif 
			@endif required="" aria-required="true" />
			<label for="hora_salida[{{ $loop->index }}]"
			@if( $errors->has('hora_salida.'.$loop->index)) 
				class="active"
			@endif></label>
		</div>

	</div>	
@endforeach
