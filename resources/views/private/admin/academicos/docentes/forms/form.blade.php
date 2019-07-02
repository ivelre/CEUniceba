<div class="section">
	<h5>Datos generales</h5>
	<p>Datos escenciales del docente.</p>
	<div class="divider"></div>
</div>

<div class="row">
	
	<div class="input-field col s12 l4">
		<i class="material-icons prefix">account_circle</i>
		<input id="nombre" name="nombre" type="text" class="validate
		@if( $errors->has('nombre')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('nombre')){{ old('nombre') }}@elseif(isset($docente)){{ $docente->nombre }}@endif" >
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
		value="@if(old('apaterno')){{ old('apaterno') }}@elseif(isset($docente)){{ $docente->apaterno }}@endif" >
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
		value="@if(old('amaterno')){{ old('amaterno') }}@elseif(isset($docente)){{ $docente->amaterno }}@endif">
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
		value="@if(old('curp')){{ old('curp') }}@elseif(isset($docente)){{ $docente->curp }}@endif">
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
		value="@if(old('fecha_nacimiento')){{ old('fecha_nacimiento') }}@elseif(isset($docente)){{ $docente->fecha_nacimiento }}@endif">
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
				@elseif(isset($docente))
					<option value="{{ $estado_civil->id }}" 
						@if($estado_civil->id == $docente->dato_general->estado_civil_id)
							selected 
						@endif >{{ $estado_civil->estado_civil }}</option>	
				@else
					<option value="{{ $estado_civil->id }}" 
						@if($estado_civil->id == 1) 
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
			@elseif(isset($docente))
				<option value="M"
					@if("M" == $docente->sexo) 
						selected 
					@endif>Hombre</option>
				<option value="F"
					@if("F" == $docente->sexo) 
						selected 
					@endif>Mujer</option>
				<option value="O"
					@if("O" == $docente->sexo) 
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
				@elseif(isset($docente))
					<option value="{{ $nacionalidad->id }}" 
						@if($nacionalidad->id == $docente->nacionalidad_id)
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
		value="@if(old('calle_numero')){{ old('calle_numero') }}@elseif(isset($docente)){{ $docente->calle_numero }}@endif">
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
		value="@if(old('colonia')){{ old('colonia') }}@elseif(isset($docente)){{ $docente->colonia }}@endif">
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
		value="@if(old('codigo_postal')){{ old('codigo_postal') }}@elseif(isset($docente)){{ $docente->codigo_postal }}@endif">
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
				@elseif(isset($docente))
					<option value="{{ $estado->id }}" 
						@if($estado->id == $docente->estado_id)
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
				@elseif(isset($docente))
					<option value="{{ $municipio->id }}" 
						@if($municipio->id == $docente->municipio_id)
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

	<div class="input-field col s12 l4" style="margin-bottom: 16px;">
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
				@elseif(isset($docente))
					<option value="{{ $localidad->id }}" 
						@if($localidad->id == $docente->localidad_id)
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
		value="@if(old('telefono_personal')){{ old('telefono_personal') }}@elseif(isset($docente)){{ $docente->telefono_personal }}@endif">
		<label for="telefono_personal">Teléfono personal</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">local_phone</i>
		<input id="telefono_casa" name="telefono_casa" type="tel"
		value="@if(old('telefono_casa')){{ old('telefono_casa') }}@elseif(isset($docente)){{ $docente->telefono_casa }}@endif">
		<label for="telefono_casa">Teléfono de casa</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">email</i>
		<input id="email" name="email" type="email"
		value="@if(old('email')){{ old('email') }}@elseif(isset($docente)){{ $docente->email }}@endif">
		<label for="email">E-mail</label>
	</div>	
</div>

<div class="row">
	<h5>Especifícos</h5>
	<p>Datos únicos del docente.</p>
	<div class="divider"></div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">account_circle</i>
		<input id="codigo" name="codigo" type="text" class="validate
		@if( $errors->has('codigo')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('codigo')){{ old('codigo') }}@elseif(isset($docente)){{ $docente->codigo }}@endif">
		<label for="codigo"
		@if( $errors->has('codigo')) 
			class="active"
			data-error=" {{ $errors->first('codigo',':message') }} "  
		@endif >*Código</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">account_circle</i>
		<input id="rfc" name="rfc" type="text" class="validate
		@if( $errors->has('rfc')) 
			invalid
		@endif" required="" aria-required="true"
		value="@if(old('rfc')){{ old('rfc') }}@elseif(isset($docente)){{ $docente->rfc }}@endif">
		<label name="rfc"
		@if( $errors->has('rfc')) 
			class="active"
			data-error=" {{ $errors->first('rfc',':message') }} "  
		@endif>*RFC</label>
	</div>

	<div class="input-field col s12 l4">
		<i class="material-icons prefix">list</i>
		<select id="titulo_id" name="titulo_id" class="validate
		@if( $errors->has('titulo_id')) 
			invalid
		@endif" required="" aria-required="true">
			@foreach($titulos as $titulo)
				@if(old('titulo_id'))
					<option value="{{ $titulo->id }}" 
						@if($titulo->id == old('titulo_id')) 
							selected 
						@endif >{{ $titulo->titulo }}</option>	
				@elseif(isset($docente))
					<option value="{{ $titulo->id }}" 
						@if($titulo->id == $docente->titulo_id)
							selected 
						@endif >{{ $titulo->titulo }}</option>	
				@else
					<option value="{{ $titulo->id }}" 
						@if($titulo->id == 1) 
							selected 
						@endif >{{ $titulo->titulo }}</option>	
				@endif
			@endforeach
		</select>
		<label for="titulo_id"
		@if( $errors->has('titulo_id')) 
			class="active"
			data-error=" {{ $errors->first('titulo_id',':message') }} "  
		@endif>*Título</label>
	</div>	
</div>

<div class="row">
	<p>Fotografía</p>
	<div class="divider"></div>
	<input id="foto" name="foto" type="file" class="dropify" data-show-remove="false" data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg"
	@if (isset($docente))
		data-default-file="{{ asset('/images/docentes/'.$docente->foto) }}"
	@endif
	/>
</div>