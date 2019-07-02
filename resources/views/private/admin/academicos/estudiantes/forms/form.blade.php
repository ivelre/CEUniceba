<div class="section">
	<h5>Datos generales</h5>
	<p>Datos escenciales del estudiante.</p>
	<div class="divider"></div>
</div>

<div class="row">
	
	<div class="input-field col s12 l4">
		<i class="material-icons prefix">account_circle</i>
		<input id="nombre" name="nombre" type="text" class="validate
		@if( $errors->has('nombre')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('nombre')){{ old('nombre') }}@elseif(isset($estudiante)){{ $estudiante->nombre }}@endif" >
		<label for="nombre"
		@if( $errors->has('nombre')) 
			class="active"
			data-error=" {{ $errors->first('nombre',':message') }} "  
		@endif>*Nombre</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="hide-on-large-only material-icons prefix">account_circle</i>
		<input id="apaterno" name="apaterno" type="text" class="validate
		@if( $errors->has('apaterno')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('apaterno')){{ old('apaterno') }}@elseif(isset($estudiante)){{ $estudiante->apaterno }}@endif" >
		<label for="apaterno"
		@if( $errors->has('apaterno')) 
			class="active"
			data-error=" {{ $errors->first('apaterno',':message') }} "  
		@endif>*Apellido paterno</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="hide-on-large-only material-icons prefix">account_circle</i>
		<input id="amaterno" name="amaterno" type="text" class="validate
		@if( $errors->has('amaterno')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('amaterno')){{ old('amaterno') }}@elseif(isset($estudiante)){{ $estudiante->amaterno }}@endif">
		<label for="amaterno" 
		@if( $errors->has('amaterno')) 
			class="active"
			data-error=" {{ $errors->first('amaterno',':message') }} "  
		@endif 
		>*Apellido Materno</label>
	</div>

	<div class="input-field col s12 l6">
		<i class="material-icons prefix">sort_by_alpha</i>
		<input id="curp" name="curp" type="text" class="validate
		@if( $errors->has('curp')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('curp')){{ old('curp') }}@elseif(isset($estudiante)){{ $estudiante->curp }}@endif">
		<label for="curp"
		@if( $errors->has('curp')) 
			class="active"
			data-error=" {{ $errors->first('curp',':message') }} "  
		@endif>*CURP</label>
	</div>

	<div class="input-field col s12 l6">
		<i class="material-icons prefix">date_range</i>
		<input id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="datepicker" class="validate
		@if( $errors->has('fecha_nacimiento')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('fecha_nacimiento')){{ old('fecha_nacimiento') }}@elseif(isset($estudiante)){{ $estudiante->fecha_nacimiento }}@endif">
		<label for="fecha_nacimiento"
		@if( $errors->has('fecha_nacimiento')) 
			class="active"
			data-error=" {{ $errors->first('fecha_nacimiento',':message') }} "  
		@endif>*Fecha de nacimiento</label>
	</div>

</div>

<div class="row">
	
	<div class="input-field col s12 m6 l4">
		<i class="material-icons prefix">favorite</i>
		<select id="estado_civil_id" name="estado_civil_id" class="validate
		@if( $errors->has('estado_civil_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($estados_civiles as $estado_civil)
				@if(old('estado_civil_id'))
					<option value="{{ $estado_civil->id }}" 
						@if($estado_civil->id == old('estado_civil_id')) 
							selected 
						@endif >{{ $estado_civil->estado_civil }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $estado_civil->id }}" 
						@if($estado_civil->id == $estudiante->dato_general->estado_civil_id)
							selected 
						@endif >{{ $estado_civil->estado_civil }}</option>	
				@else
					<option value="{{ $estado_civil->id }}" 
						@if($loop->first) 
							selected 
						@endif >{{ $estado_civil->estado_civil }}</option>	
				@endif
			@endforeach
		</select>
		<label for="estado_civil_id"
		@if( $errors->has('estado_civil_id')) 
			class="active"
			data-error=" {{ $errors->first('estado_civil_id',':message') }} "  
		@endif>*Estado civil</label>
	</div>

	<div class="input-field col s12 m6 l4">
		<i class="material-icons prefix">wc</i>
		<select id="sexo" name="sexo" class="validate
		@if( $errors->has('sexo')) 
			invalid
		@endif" required="" aria-required="true">
			@if(old('sexo'))
				<option value="M"
					@if("M" == old('sexo')) 
						selected 
					@endif>Hombre</option>
				<option value="F"
					@if("F" == old('sexo')) 
						selected 
					@endif>Mujer</option>
				<option value="O"
					@if("O" == old('sexo')) 
						selected 
					@endif>Otro</option>
			@elseif(isset($estudiante))
				<option value="M"
					@if("M" == $estudiante->sexo) 
						selected 
					@endif>Hombre</option>
				<option value="F"
					@if("F" == $estudiante->sexo) 
						selected 
					@endif>Mujer</option>
				<option value="O"
					@if("O" == $estudiante->sexo) 
						selected 
					@endif>Otro</option>
			@else
				<option value="M">Hombre</option>
				<option value="F">Mujer</option>
				<option value="O">Otro</option>
			@endif
		</select>
		<label for="sexo" 
		@if( $errors->has('sexo')) 
			class="active"
			data-error=" {{ $errors->first('sexo',':message') }} "  
		@endif>*Sexo</label>
	</div>

	<div class="input-field col s12 m12 l4">
		<i class="material-icons prefix">flag</i>
		<select id="nacionalidad_id" name="nacionalidad_id" class="validate
		@if($errors->has('nacionalidad_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($nacionalidades as $nacionalidad)
				@if(old('nacionalidad_id'))
					<option value="{{ $nacionalidad->id }}" 
						@if($nacionalidad->id == old('nacionalidad_id')) 
							selected 
						@endif >{{ $nacionalidad->nacionalidad }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $nacionalidad->id }}" 
						@if($nacionalidad->id == $estudiante->nacionalidad_id)
							selected 
						@endif >{{ $nacionalidad->nacionalidad }}</option>	
				@else
					<option value="{{ $nacionalidad->id }}" 
						@if($nacionalidad->id == 104) 
							selected 
						@endif >{{ $nacionalidad->nacionalidad }}</option>	
				@endif
			@endforeach
		</select>
		<label for="nacionalidad_id"
		@if( $errors->has('nacionalidad_id')) 
			class="active"
			data-error=" {{ $errors->first('nacionalidad_id',':message') }} "  
		@endif>*Nacionalidad</label>
	</div>

</div>

<div class="row">
	<p>Dirección</p>
	<div class="divider"></div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">theaters</i>
		<input id="calle_numero" name="calle_numero" type="text" class="validate
		@if( $errors->has('calle_numero')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('calle_numero')){{ old('calle_numero') }}@elseif(isset($estudiante)){{ $estudiante->calle_numero }}@endif">
		<label for="calle_numero"
		@if( $errors->has('calle_numero')) 
			class="active"
			data-error=" {{ $errors->first('calle_numero',':message') }} "  
		@endif>*Calle y número</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">tab_unselected</i>
		<input id="colonia" name="colonia" type="text" class="validate
		@if( $errors->has('colonia')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('colonia')){{ old('colonia') }}@elseif(isset($estudiante)){{ $estudiante->colonia }}@endif">
		<label for="colonia"
		@if( $errors->has('colonia')) 
			class="active"
			data-error=" {{ $errors->first('colonia',':message') }} "  
		@endif>*Colonia</label>
	</div>	

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">filter_5</i>
		<input id="codigo_postal" name="codigo_postal" type="number" min=1 class="validate
		@if( $errors->has('codigo_postal')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('codigo_postal')){{ old('codigo_postal') }}@elseif(isset($estudiante)){{ $estudiante->codigo_postal }}@endif">
		<label for="codigo_postal"
		@if( $errors->has('codigo_postal')) 
			class="active"
			data-error=" {{ $errors->first('codigo_postal',':message') }} "  
		@endif>*Código postal</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">broken_image</i>
		<select id="estado_id" name="estado_id">
			@foreach($estados as $estado)
				@if(old('estado_id'))
					<option value="{{ $estado->id }}" 
						@if($estado->id == old('estado_id')) 
							selected 
						@endif >{{ $estado->estado }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $estado->id }}" 
						@if($estado->id == $estudiante->estado_id)
							selected 
						@endif >{{ $estado->estado }}</option>	
				@else
					<option value="{{ $estado->id }}" 
						@if($estado->id == 11) 
							selected 
						@endif >{{ $estado->estado }}</option>	
				@endif
			@endforeach
		</select>
		<label for="estado_id">Estado</label>
	</div>

	<div class="input-field col s12 l4" style="margin-bottom: 16px;">
		<i class="material-icons prefix">location_city</i>
		<select id="municipio_id" name="municipio_id">			
			@foreach($municipios as $municipio)
				@if(old('municipio_id'))
					<option value="{{ $municipio->id }}" 
						@if($municipio->id == old('municipio_id')) 
							selected 
						@endif >{{ $municipio->municipio }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $municipio->id }}" 
						@if($municipio->id == $estudiante->municipio_id)
							selected 
						@endif >{{ $municipio->municipio }}</option>	
				@else
					<option value="{{ $municipio->id }}" 
						@if($municipio->id == 327) 
							selected 
						@endif >{{ $municipio->municipio }}</option>	
				@endif
			@endforeach
		</select>
		<label class="active" for="municipio_id">Municipio</label>
	</div>	

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">domain</i>
		<select id="localidad_id" name="localidad_id" class="validate
		@if( $errors->has('localidad_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($localidades as $localidad)
				@if(old('localidad_id'))
					<option value="{{ $localidad->id }}" 
						@if($localidad->id == old('localidad_id')) 
							selected 
						@endif >{{ $localidad->localidad }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $localidad->id }}" 
						@if($localidad->id == $estudiante->localidad_id)
							selected 
						@endif >{{ $localidad->localidad }}</option>	
				@else
					<option value="{{ $localidad->id }}" 
						@if($localidad->id == 94493) 
							selected 
						@endif >{{ $localidad->localidad }}</option>	
				@endif
			@endforeach
		</select>
		<label class="active" for="localidad_id"
		@if( $errors->has('localidad_id')) 
			class="active"
			data-error=" {{ $errors->first('localidad_id',':message') }} "  
		@endif>*Localidad</label>
	</div>	

</div>

<div class="row">
	<p>Contacto</p>
	<div class="divider"></div>
	
	<div class="input-field col s12 l4">
		<i class="material-icons prefix">phone_android</i>
		<input id="telefono_personal" name="telefono_personal" type="tel"
		value="@if(old('telefono_personal')){{ old('telefono_personal') }}@elseif(isset($estudiante)){{ $estudiante->telefono_personal }}@endif">
		<label for="telefono_personal">Teléfono personal</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">local_phone</i>
		<input id="telefono_casa" name="telefono_casa" type="tel"
		value="@if(old('telefono_casa')){{ old('telefono_casa') }}@elseif(isset($estudiante)){{ $estudiante->telefono_casa }}@endif">
		<label for="telefono_casa">Teléfono de casa</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">email</i>
		<input id="email" name="email" type="email"
		value="@if(old('email')){{ old('email') }}@elseif(isset($estudiante)){{ $estudiante->email }}@endif">
		<label for="email">E-mail</label>
	</div>	
</div>

<div class="row">
	<p>Fotografía</p>
	<div class="divider"></div>
	<input id="foto" name="foto" type="file" class="dropify" data-show-remove="false" data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg"
	@if (isset($estudiante))
		data-default-file="{{ asset('/images/estudiantes/'.$estudiante->foto) }}"
	@endif
	/>
</div>

<div class="section">
	<h5>Especficos</h5>
	<p>Datos únicos del estudiante</p>
	<div class="divider"></div>
</div>

<div class="row">
	
	<div class="input-field col s12 l4">
		<i class="material-icons prefix">school</i>
		<select id="nivel_academico_id" name="nivel_academico_id" class="validate
		@if( $errors->has('nivel_academico_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($niveles_academicos as $nivel_academico)
				@if(old('nivel_academico_id'))
					<option value="{{ $nivel_academico->id }}" 
						@if($nivel_academico->id == old('nivel_academico_id')) 
							selected 
						@endif >{{ $nivel_academico->nivel_academico }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $nivel_academico->id }}" 
						@if($nivel_academico->id == $estudiante->nivel_academico_id)
							selected 
						@endif >{{ $nivel_academico->nivel_academico }}</option>	
				@else
					<option value="{{ $nivel_academico->id }}" 
						@if($loop->first) 
							selected 
						@endif >{{ $nivel_academico->nivel_academico }}</option>	
				@endif
			@endforeach
		</select>
		<label for="nivel_academico_id"
		@if( $errors->has('nivel_academico_id')) 
			class="active"
			data-error=" {{ $errors->first('nivel_academico_id',':message') }} "  
		@endif>Nivel académico</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">account_balance</i>
		<select id="especialidad_id" name="especialidad_id" class="validate
		@if( $errors->has('especialidad_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($especialidades as $especialidad)
				@if(old('especialidad_id'))
					<option value="{{ $especialidad->id }}" 
						@if($especialidad->id == old('especialidad_id')) 
							selected 
						@endif >{{ $especialidad->especialidad }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $especialidad->id }}" 
						@if($especialidad->id == $estudiante->especialidad_id)
							selected 
						@endif >{{ $especialidad->especialidad }}</option>	
				@else
					<option value="{{ $especialidad->id }}" 
						@if($loop->first) 
							selected 
						@endif >{{ $especialidad->especialidad }}</option>	
				@endif
			@endforeach
		</select>
		<label for="especialidad_id"
		@if( $errors->has('especialidad_id')) 
			class="active"
			data-error=" {{ $errors->first('especialidad_id',':message') }} "  
		@endif>*Especialidad</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">list</i>
		<select id="plan_especialidad_id" name="plan_especialidad_id" class="validate
		@if( $errors->has('plan_especialidad_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($planes_especialidades as $plan_especialidad)
				@if(old('plan_especialidad_id'))
					<option value="{{ $plan_especialidad->id }}" 
						@if($plan_especialidad->id == old('plan_especialidad_id')) 
							selected 
						@endif >{{ $plan_especialidad->plan_especialidad }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $plan_especialidad->id }}" 
						@if($plan_especialidad->id == $estudiante->plan_especialidad_id)
							selected 
						@endif >{{ $plan_especialidad->plan_especialidad }}</option>	
				@else
					<option value="{{ $plan_especialidad->id }}" 
						@if($loop->last) 
							selected 
						@endif >{{ $plan_especialidad->plan_especialidad }}</option>	
				@endif
			@endforeach
		</select>
		<label for="plan_especialidad_id"
		@if( $errors->has('plan_especialidad_id')) 
			class="active"
			data-error=" {{ $errors->first('plan_especialidad_id',':message') }} "  
		@endif>*Plan de Estudio</label>
	</div>

	<div class="input-field col s12 l3">
		<i class="material-icons prefix">vpn_key</i>
		<input id="matricula" name="matricula" type="text" class="validate
		@if( $errors->has('matricula')) 
			invalid
		@endif" required="required" aria-required="true"
		value="@if(old('matricula')){{ old('matricula') }}@elseif(isset($estudiante)){{ $estudiante->matricula }}@elseif(isset($nueva_matricula)){{ $nueva_matricula }}@endif">
		<label for="matricula"
		@if( $errors->has('matricula')) 
			class="active"
			data-error=" {{ $errors->first('matricula',':message') }} "  
		@endif>*Matrícula</label>
	</div>

	<div class="input-field col s12 l3">
		<i class="material-icons prefix">group</i>
		<select name="grupo" id="grupo" class="validate
		@if( $errors->has('grupo')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('grupo')){{ old('grupo') }}@elseif(isset($estudiante)){{ $estudiante->grupo }}@endif">
			<option value="">Seleccione un grupo</option>
			@foreach($grupos as $grupo)
			<option value="{{ $grupo->grupo }}" id="g-{{ $grupo->grupo }}">{{ $grupo->grupo }}</option>
			@endforeach
		</select>
		<label for="grupo"
		@if( $errors->has('grupo')) 
			class="active"
			data-error=" {{ $errors->first('grupo',':message') }} "  
		@endif>*Grupo</label>
		@if(isset($estudiante))
		@section('inline-script')
		<script type="text/javascript">$("#grupo").val('{{$estudiante->grupo}}').change();</script>
		@endsection
		@endif
	</div>

	<div class="input-field col s12 l3">
		<i class="material-icons prefix">traffic</i>
		<select id="estado_estudiante_id" name="estado_estudiante_id" class="validate
		@if( $errors->has('estado_estudiante_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($estados_estudiantes as $estado_estudiante)
				@if(old('estado_estudiante_id'))
					<option value="{{ $estado_estudiante->id }}" 
						@if($estado_estudiante->id == old('estado_estudiante_id')) 
							selected 
						@endif >{{ $estado_estudiante->estado_estudiante }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $estado_estudiante->id }}" 
						@if($estado_estudiante->id == $estudiante->estado_estudiante_id)
							selected 
						@endif >{{ $estado_estudiante->estado_estudiante }}</option>	
				@else
					<option value="{{ $estado_estudiante->id }}" 
						@if($loop->first) 
							selected 
						@endif >{{ $estado_estudiante->estado_estudiante }}</option>	
				@endif
			@endforeach
		</select>
		<label for="estado_estudiante_id"
		@if( $errors->has('estado_estudiante_id')) 
			class="active"
			data-error=" {{ $errors->first('estado_estudiante_id',':message') }} "  
		@endif>*Estado</label>
	</div>

	<div class="input-field col s12 l3">
		<i class="material-icons prefix">sort</i>
		<select id="modalidad_id" name="modalidad_id" class="validate
		@if( $errors->has('modalidad_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($modalidades_estudiantes as $modalidad_estudiante)
				@if(old('modalidad_id'))
					<option value="{{ $modalidad_estudiante->id }}" 
						@if($modalidad_estudiante->id == old('modalidad_id')) 
							selected 
						@endif >{{ $modalidad_estudiante->modalidad_estudiante }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $modalidad_estudiante->id }}" 
						@if($modalidad_estudiante->id == $estudiante->modalidad_id)
							selected 
						@endif >{{ $modalidad_estudiante->modalidad_estudiante }}</option>	
				@else
					<option value="{{ $modalidad_estudiante->id }}" 
						@if($loop->first) 
							selected 
						@endif >{{ $modalidad_estudiante->modalidad_estudiante }}</option>	
				@endif
			@endforeach
		</select>
		<label for="modalidad_id"
		@if( $errors->has('modalidad_id')) 
			class="active"
			data-error=" {{ $errors->first('modalidad_id',':message') }} "  
		@endif>*Modalidad</label>
	</div>

</div>

<div class="row">
	<div class="input-field col s12">
		<i class="material-icons prefix">mode_edit</i>
		<textarea id="otros" name="otros" class="materialize-textarea">@if(old('otros')){{ old('otros') }}@elseif(isset($estudiante)){{ $estudiante->otros }}@endif</textarea>
		<label for="otors">Detalles</label>
	</div>
</div>

<div class="section">
	<h5>Referencias</h5>
	<p>Datos de referencia del estudiante</p>
	<div class="divider"></div>
</div>

<div class="row">
	<div class="input-field col s12">
		<i class="material-icons prefix">compare_arrows</i>
		<select id="medio_enterado_id" name="medio_enterado_id" class="validate
		@if( $errors->has('medio_enterado_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($medios_enterados as $medio_enterado)
				@if(old('medio_enterado_id'))
					<option value="{{ $medio_enterado->id }}" 
						@if($medio_enterado->id == old('medio_enterado_id')) 
							selected 
						@endif >{{ $medio_enterado->medio_enterado }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $medio_enterado->id }}" 
						@if($medio_enterado->id == $estudiante->medio_enterado_id)
							selected 
						@endif >{{ $medio_enterado->medio_enterado }}</option>	
				@else
					<option value="{{ $medio_enterado->id }}" 
						@if($loop->first) 
							selected 
						@endif >{{ $medio_enterado->medio_enterado }}</option>	
				@endif
			@endforeach
		</select>
		<label for="medio_enterado_id"
		@if( $errors->has('medio_enterado_id')) 
			class="active"
			data-error=" {{ $errors->first('medio_enterado_id',':message') }} "  
		@endif>*Enterado por</label>
	</div>

	<div class="input-field col s8" style="margin-bottom: 16px;">
		<i class="material-icons prefix">school</i>
		<select id="instituto_id" name="instituto_id" class="validate
		@if( $errors->has('instituto_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($institutos as $institucion)
				@if(old('instituto_id'))
					<option value="{{ $institucion->id }}" 
						@if($institucion->id == old('instituto_id')) 
							selected 
						@endif >{{ $institucion->institucion }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $institucion->id }}" 
						@if($institucion->id == $estudiante->instituto_id)
							selected 
						@endif >{{ $institucion->institucion }}</option>	
				@else
					<option value="{{ $institucion->id }}" 
						@if($loop->first) 
							selected 
						@endif >{{ $institucion->institucion }}</option>	
				@endif
			@endforeach
		</select>
		<label for="instituto_id" class="active"
		@if( $errors->has('instituto_id')) 
			class="active"
			data-error=" {{ $errors->first('instituto_id',':message') }} "  
		@endif>*Instituto de procedencia</label>
	</div>
	<div class="input-field col s4">
		<div class="right-align">
			<a class="waves-effect waves-light btn center-align blue darken-2" id="create_instituto" style="width: 100%">Nuevo instituto</a>
		</div>
	</div>

	<div class="input-field col s8" style="margin-bottom: 16px;">
		<i class="material-icons prefix">work</i>
		<select id="empresa_id" name="empresa_id" class="validate
		@if( $errors->has('empresa_id')) 
			invalid
		@endif">
			@foreach($empresas as $empresa)
				@if(old('empresa_id'))
					<option value="{{ $empresa->id }}" 
						@if($empresa->id == old('empresa_id')) 
							selected 
						@endif >{{ $empresa->empresa }}</option>	
				@elseif(isset($estudiante))
					<option value="{{ $empresa->id }}" 
						@if($empresa->id == $estudiante->empresa_id)
							selected 
						@endif >{{ $empresa->empresa }}</option>	
				@else
					<option value="{{ $empresa->id }}" 
						@if($loop->first) 
							selected 
						@endif >{{ $empresa->empresa }}</option>	
				@endif
			@endforeach
		</select>
		<label for="empresa_id" class="active"
		@if( $errors->has('empresa_id')) 
			class="active"
			data-error=" {{ $errors->first('empresa_id',':message') }} "  
		@endif>Trabajo</label>
	</div>
	<div class="input-field col s4">
		<div class="right-align">
			<a class="waves-effect waves-light btn center-align blue darken-2" id="create_empresa" style="width: 100%" >Nuevo trabajo</a>
		</div>
	</div>

	<div class="input-field col s12">
		<i class="material-icons prefix">filter_list</i>
		<input id="puesto" name="puesto" type="text" class="validate"
		value="@if(old('puesto')){{ old('puesto') }}@elseif(isset($estudiante)){{ $estudiante->puesto }}@endif">
		<label for="puesto">Puesto</label>
	</div>
</div>

<div class="section">
	<h5>Documentos</h5>
	<p>Documentación entreganda por el estudiante.</p>
	<div class="divider"></div>
</div>

<div id="documentos" class="row" no_documentos="{{count($tipos_documentos)}}">
@foreach($tipos_documentos as $tipo_documento)
	<div id="tipos" class=" col s4 valign-wrapper">
		<div class="col s6">
	    <input type="checkbox" class="filled-in" id="tipo_documento_{{ $loop->index }}" name="tipo_documento[{{ $loop->index }}]" value="{{ $tipo_documento->id }}" index="{{ $loop->index }}"
	    @if (isset($documentos_estudiantes))
	    	@foreach ($documentos_estudiantes as $documento_estudiante)
	    		@if ($documento_estudiante->id == $tipo_documento->id)
	    			checked="checked"
	    		@endif
	    	@endforeach
	    @else
	    	@if ($errors->has('tipo_documento.'.$loop->index) || old('tipo_documento'.$loop->index))
	    		checked="checked"
	    	@endif
	    @endif/>
	    <label for="tipo_documento_{{ $loop->index }}"/>{{ $tipo_documento->tipo_documento }}</label>
		</div>

		<div class="col s6">
			<input id="documento_{{$loop->index}}" name="documento[{{ $tipo_documento->id }}]" type="file" class="dropify" data-show-remove="false" data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg"
			@if (isset($documentos_estudiantes))
				{{ $match = false }}
				@foreach ($documentos_estudiantes as $documento_estudiante)
	    		@if ($documento_estudiante->id == $tipo_documento->id)
	    			@if ($documento_estudiante->documento != null)
	    				data-default-file="{{ asset('/images/estudiantes/'.$documento_estudiante->pivot->documento) }}"
	    			@endif
	    			{{ $match = true}}
	    		@endif
	    	@endforeach
	    	@if (!$match)
	    		disabled="disabled"	
	    	@endif
			@elseif(!$errors->has('documento.'.$loop->index) && !old('documento.'.$loop->index))
				disabled="disabled"
			@endif/>
		</div>
	</div>	
@endforeach	
</div>
