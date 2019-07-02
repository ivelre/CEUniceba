@extends('private.admin.layouts.scaffold')

@section('title')
	UNICEBA - Examenes
@endsection

@section('content')

	<div class="row">
		<div class="col s10 offset-s1">

			<div class="section">
		  	<h4>Grupo {{ $clase->clase }} de {{ $clase->asignatura->asignatura }}</h4>
		  	<div class="divider"></div>
			</div>
			<h5><a class="valign-wrapper" href="{{route('clases.index')}}"><i class="material-icons">arrow_back</i> Regresar</a></h5>
			<br>
	
			<h5>Datos de la clase</h5>
            <div class="divider"></div>

            <div class="row">
                <div class="col s10 offset-s1 ">
                    <p>Clase: {{ $clase->clase }}</p>
                    <p>Turno: {{ $clase->turno }}</p>
                    <p>Periodo: {{ $clase->periodo->periodo }} ({{ $clase->periodo->anio }})</p>
                    <p>Docente: {{ $clase->docente->dato_general->nombre }} {{ $clase->docente->dato_general->apaterno }} {{ $clase->docente->dato_general->amaterno }}</p>

                    <table>
                        <thead>
                            <tr>
                                @foreach ($dias as $dia)
                                    <th>{{ $dia->dia }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                @foreach ($dias as $dia)
                                    <td>
                                    @foreach ($clase->horarios as $horario)
                                        @if ($horario->dia_id == $dia->id)
                                            {{ date("H:i", strtotime($horario->hora_entrada)).' : '.date("H:i", strtotime($horario->hora_salida)) }}
                                        @endif
                                    @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <h5>Agregar Alumno</h5>
            <div class="divider"></div>

            <form id="form_grupo" novalidate="novalidate">
                <div class="row">

                    <input type="hidden" id="clase_id" name="clase_id" value="{{$clase->id}}">
                    <input type="hidden" id="estudiante_id" name="estudiante_id">
                    <input type="hidden" id="oportunidad_id" name="oportunidad_id">
                    <input type="hidden" id="especialidad_id" name="especialidad_id" value="{{$clase->especialidad_id}}">

                                       
                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input id="matricula" name="matricula" type="text">
                        <label for="matricula">Matricula</label>
                    </div>

                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input id="nombre" name="nombre" type="text" disabled>
                        <label for="nombre">Nombre</label>
                    </div>

                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input id="semestre" name="semestre" type="text" disabled>
                        <label for="semestre">Semestre</label>
                    </div>

                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input id="oportunidad" name="oportunidad" type="text" disabled>
                        <label for="oportunidad">Oportunidad</label>
                    </div>
                    
                </div><br>
                <div class="section">
                    <div class="input-field col s12">
                            <div class="right-align">
                                <a id="cancel_plan_especialidad" class="waves-effect waves-light btn red darken-2 hide">Cancelar<i class="material-icons left">clear</i></a>
                                <button id="save_fecha_examen" class="waves-effect waves-light btn center-align blue darken-2" type="submit">Guardar<i class="material-icons left">send</i></button>
                            </div>
                        </div>
                </div>
            </form>

            <h5>Imprimir calificaciones</h5>
            <div class="divider"></div>

            <div class="row">
                <br>

                <div class="col s4"><button id="openActa" class="col s12 waves-effect waves-light btn center-align blue darken-2">Ordinario<i class="material-icons left">print</i></button></div>


                <div class="col s4"><button id="openActaEX" class="col s12 waves-effect waves-light btn center-align blue darken-2">Extraordinarios<i class="material-icons left">print</i></button></div>

                <div class="col s4"><button id="openActaES" class="col s12 waves-effect waves-light btn center-align blue darken-2">Especiales<i class="material-icons left">print</i></button> </div>

            </div>

            <div class="row">

                <div class="col s4"><button id="openActaSC" class="col s12 waves-effect waves-light btn center-align blue darken-2">Ordinario S/C<i class="material-icons left">print</i></button></div>


                <div class="col s4"><button id="openActaEXSC" class="col s12 waves-effect waves-light btn center-align blue darken-2">Extraordinarios S/C<i class="material-icons left">print</i></button></div>

                <div class="col s4"><button id="openActaESSC" class="col s12 waves-effect waves-light btn center-align blue darken-2">Especiales S/C<i class="material-icons left">print</i></button> </div>


            <div class="row">
                <br>
                <div class="col s4"><br>

                <button id="openLista" class="col s12 waves-effect waves-light btn center-align blue darken-2">Lista de asistencia<i class="material-icons left">print</i></button></div>

            </div>

			<table id="table_grupo" class="display highlight bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Semestre</th>
                        <th>Calificación</th>
                        <th>Oportunidad</th>
                        <th>Quitar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumnos as $key => $alumno)
                    <tr>
                        <td>{{ $alumno -> matricula }}</td>
                        <td>{{ $alumno -> nombre }}</td>
                        <td>{{ $alumno -> semestre }}</td>
                        <td>
                            {{-- {{ $alumno -> calificacion }} <br> --}}
                            <input class="col s6 offset-s3" id="cal_{{ $alumno -> kardex_id}}" type="number" min="0" max="10" value="{{ $alumno -> calificacion }}">
                        </td>
                        <td>{{ $alumno -> oportunidad }}</td>
                        <td>
                            @if(isset($alumno -> kardex_id))
                            <a onclick="deleteEstudiante({{ $alumno -> kardex_id}},{{ $alumno -> grupo_id}})" class="btn-floating btn-meddium waves-effect waves-light delete-grupo">
                            @else
                            <a onclick="deleteEstudiante(null,{{ $alumno -> grupo_id}})" class="btn-floating btn-meddium waves-effect waves-light delete-grupo">
                            @endif
                                <i class="material-icons circle red">close</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Semestre</th>
                        <th>Calificación</th>
                        <th>Oportunidad</th>
                        <th>Quitar</th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
		</div>
	</div>
@endsection

@section('script')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script type="text/javascript" src="{{ asset('/js/admin/academicos/grupos.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        $('#openActa').click(function(event) {
            printActa(1,1)
        });

        $('#openActaSC').click(function(event) {
            printActa(2,null)
        });

        $('#openActaEX').click(function(event) {
            printActa(2,2)
        });

        $('#openActaES').click(function(event) {
            printActa(2,3)
        });

        $('#openActaEXSC').click(function(event) {
            printActa(1,2)
        });

        $('#openActaESSC').click(function(event) {
            printActa(1,3)
        });

        $('#openLista').click(function(event) {
            printActa(3,null)
        });

        function printActa(tipo,oportunidad_id){
            if(tipo != 3)
                var date = prompt("Por favor introduzca una fecha.", '{{\Session::get('date_acta')}}');
            else
                var date = '00-00-0000'
            var gruposPrint = {}
            gruposPrint._token = '{{ csrf_token() }}';
            gruposPrint.grupos = {};
            gruposPrint.oportunidad_id = oportunidad_id;
            gruposPrint.grupos[0] = {clase_id : {{$clase -> id}},print:true };
            console.log(gruposPrint);

            if (date == null || date == "") {
                alert ('No ha ingresado una fecha');
            } else {
                axios.get('../pdf/grupo/setDate/' + date)
                .catch(function (error) {
                    console.log(error);
                })
                axios.post('../pdf/grupo/gruposPrint',gruposPrint).then(response=>{
                    if(tipo == 3)
                        window.open('../pdf/grupo/lista/', '_blank');
                    else
                        window.open('../pdf/grupo/calificaciones/' + tipo, '_blank');
                }).catch(response=>{
                    console.log(response);
                })
                
            }
        }

        function initCals(){
            @foreach ($alumnos as $alumno)
            $('#cal_{{ $alumno -> kardex_id }}').focusout(function() {
                if($('#cal_{{ $alumno -> kardex_id }}').val() >= 0 && $('#cal_{{ $alumno -> kardex_id }}').val() <= 10){
                    var calificacion = {}
                    calificacion._token = '{{ csrf_token() }}';
                    calificacion.calificacion = $('#cal_{{ $alumno -> kardex_id }}').val();
                    @if (isset($alumno -> kardex_id))
                    calificacion.kardex_id = {{ $alumno -> kardex_id }};
                    @endif

                    axios.post('{{ route('guardar.calificacion') }}',calificacion).then(response=>{
                        if(response.data)
                            Materialize.toast('Calificación cambiada', 4000)
                    }).catch(response=>{
                        console.log(response);
                    })
                }else{
                    $('#cal_{{ $alumno -> kardex_id }}').val({{ $alumno -> calificacion }})
                    Materialize.toast('La calificación debe estar en un rango entre 0 y 10', 5000)
                    // console.log('La calificación debe estar en un rango entre 0 y 10')
                }
            })
            @endforeach
        }

        function deleteEstudiante(kardex_id,grupo_id){
            swal({
                title: "Desea eliminar al estudiante del grupo?",
                text: "Esta acción no se puede revertir",
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: "Cancelar"
            }).then(function(a) {
                if(a.value){
                    var deleteGrupo = {}
                    deleteGrupo._token = '{{ csrf_token() }}';
                    deleteGrupo.kardex_id = kardex_id;
                    deleteGrupo.grupo_id = grupo_id;
                    axios.post('{{ route('delete.grupo.kardex') }}',deleteGrupo).then(response=>{
                        Materialize.toast('Estudiante eliminado', 4000)
                        location.reload();
                    }).catch(response=>{
                        swal({
                            type: "error",
                            title: "Error al eliminar el estudiante",
                            text: "El estudiante esta relacionado con uno o más datos"
                        })
                    })
                }
            })
        }

        $('#table_grupo').on( 'page.dt', function () {
           initCals()
           // console.log('change');
        } );

        initCals()
    </script>
@endsection