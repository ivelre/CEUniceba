@extends('private.admin.layouts.scaffold')

@section('title')
	Guardar estudiante cargado
@endsection

@section('content')
	<div class="row" id="v-app">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Guardar estudiante cargado</h4>
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('estudiantes.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			<br>

            <div class="row">
                <div class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <i class="material-icons prefix">textsms</i>
                      <input type="text" id="autocomplete-input" class="autocomplete">
                      <label for="autocomplete-input">Autocomplete</label>
                    </div>
                  </div>
                </div>
              </div>
	
			<div class="section">
        <p>@{{ datoGeneral }}</p>
        <p>@{{ estudiante }}</p>
			</div>
---------------------------------------------------------------------------------------------------------
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
    @endif" required="" aria-required="true"
    value="@if(old('matricula')){{ old('matricula') }}@elseif(isset($estudiante)){{ $estudiante->matricula }}@elseif(isset($nueva_matricula)){{ $nueva_matricula }}@endif"
    @if (isset($estudiante) || isset( $nueva_matricula ))
      disabled
    @endif>
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
    <br>
    <button onclick="saveEstudiante()" class="waves-effect waves-light btn blue"><i class="material-icons left">send</i>Guardar</button>
		</div>
	</div>
---------------------------------------------------------------------------------------------------------
@endsection

@section('script')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
  <script type="text/javascript" src="{{ asset('js/admin/academicos/form.estudiantes.js') }}"></script>
	<script type="text/javascript">
    var app = new Vue({
      el: '#v-app',
      data: {
        datoGeneral: {},
        estudiante: {}
      }
    })
    var data = {}
    @foreach ($datosGenerales as $datoGeneal)
        data['{{$datoGeneal -> nombre}} {{$datoGeneal -> apaterno}} {{$datoGeneal -> amaterno}}'] = []
        data['{{$datoGeneal -> nombre}} {{$datoGeneal -> apaterno}} {{$datoGeneal -> amaterno}}'][0] = '{{$datoGeneal -> id}}'
    @endforeach
    $(document).ready(function(){
     $('input.autocomplete').autocomplete({
            data: data,
            limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
            onAutocomplete: function(val) {
              // Callback function when value is autcompleted.
            },
            minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
          });
     $('input.autocomplete').change(function(event) {
      //swal('Id de ' + $('input.autocomplete').val() + ' es ' + data[$('input.autocomplete').val()][0])
       //app.getEstudiante($('input.autocomplete').val())
      axios.get('/controlescolar/admin/academicos/estudiantes/dato/general/' + data[$('input.autocomplete').val()][0]).then(function (response) {
            app.datoGeneral = response.data
            app.$forceUpdate()
          })
      axios.get('/controlescolar/admin/academicos/estudiantes/' + data[$('input.autocomplete').val()][0]).then(function (response) {
            if(typeof response.data.matricula !== "undefined")
              swal('Esta persona ya es un estudiante')
            app.estudiante = response.data
            app.$forceUpdate()
          })
      });
    });

    function saveEstudiante(){
      dataPost = {
          dato_general_id: data[$('input.autocomplete').val()][0],
          especialidad_id: $('#especialidad_id').val(),
          estado_estudiante_id: $('#estado_estudiante_id').val(),
          matricula: $('#matricula').val(),
          // semestre: $('#autocomplete').val(),
          semestre_disp: '',
          grupo: $('#grupo').val(),
          modalidad_id: $('#modalidad_id').val(),
          medio_enterado_id: $('#medio_enterado_id').val(),
          otros: $('#otros').val(),
          empresa_id: $('#empresa_id').val(),
          puesto: $('#puesto').val(),
          instituto_id: $('#instituto_id').val(),
          // usuario_id: 4367,
          plan_especialidad_id: $('#plan_especialidad_id').val()
          // clave_pago: null
      }

      console.log(dataPost)
      axios.post('{{ route('estudiante.guardar') }}',dataPost).then(function (response) {
            swal('Listo','Se ha guardado el estudiante.','success')
          }).catch(function (error) {
            swal('Lo sentimos','Favor de revisar que todo los campos estén llenos.','danger')
          })
    }
  </script>
@endsection
