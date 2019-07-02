<?php

namespace App\Http\Controllers\Admin\Academicos;

use App\Models\Estudiante;
use App\Models\EstadoCivil;
use App\Models\Nacionalidad;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Localidad;
use App\Models\NivelAcademico;
use App\Models\ModalidadEstudiante;
use App\Models\EstadoEstudiante;
use App\Models\MedioEnterado;
use App\Models\InstitutoProcedencia;
use App\Models\Empresa;
use App\Models\Especialidad;
use App\Models\PlanEspecialidad;
use App\Models\TipoDocumentoEstudiante;
use App\Models\Periodo;
use App\Models\Usuario;
use App\Models\DatoGeneral;
use App\Models\DataTable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\Admin\Estudiante\StoreRequest;
use App\Http\Requests\Admin\Estudiante\UpdateRequest;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.academicos.estudiantes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nueva_matricula = Estudiante::max('matricula') + 1;
        $grupos = DataTable::estudiantes()->select('grupo')->distinct()->get();

        return view('private.admin.academicos.estudiantes.create',[
            'empresas'                  => Empresa::orderBy('id','ASC')->get(),
            'especialidades'            => Especialidad::where('nivel_academico_id',1)->orderBy('id','ASC')->get(),
            'estados_civiles'           => EstadoCivil::orderBy('estado_civil','ASC')->get(),
            'estados_estudiantes'       => EstadoEstudiante::orderBy('id','ASC')->get(),
            'estados'                   => Estado::orderBy('estado','ASC')->get(),
            'grupos'                    => $grupos,
            'institutos'                => InstitutoProcedencia::orderBy('id','ASC')->get(),
            'localidades'               => Localidad::where('municipio_id',327)->orderBy('localidad','ASC')->get(),
            'medios_enterados'          => MedioEnterado::orderBy('id','ASC')->get(),
            'modalidades_estudiantes'   => ModalidadEstudiante::orderBy('id','ASC')->get(),
            'municipios'                => Municipio::where('estado_id',11)->orderBy('municipio','ASC')->get(),
            'nacionalidades'            => Nacionalidad::orderBy('nacionalidad','ASC')->get(),
            'nueva_matricula'           => $nueva_matricula,
            'niveles_academicos'        => NivelAcademico::orderBy('id','ASC')->get(),
            'planes_especialidades'     => PlanEspecialidad::where('especialidad_id',1)->orderBy('id','ASC')->get(),
            'tipos_documentos'          => TipoDocumentoEstudiante::orderBy('id','asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $periodo = Periodo::orderBy('id','desc')->first();

        $usuario = new Usuario;
        $usuario->email     = $request->matricula.'@uniceba.edu.mx';
        $usuario->password  = password_hash('secret',PASSWORD_BCRYPT);
        $usuario->rol_id    = 2;
        $usuario->save();

        $dato_general = new DatoGeneral;
        $dato_general->curp                 = $request->curp;
        $dato_general->nombre               = $request->nombre;
        $dato_general->apaterno             = $request->apaterno;
        $dato_general->amaterno             = $request->amaterno;
        $dato_general->fecha_nacimiento     = $request->fecha_nacimiento_submit;
        $dato_general->calle_numero         = $request->calle_numero;
        $dato_general->colonia              = $request->colonia;
        $dato_general->localidad_id         = $request->localidad_id;
        $dato_general->telefono_personal    = $request->telefono_personal;
        $dato_general->telefono_casa        = $request->telefono_casa;
        $dato_general->estado_civil_id      = $request->estado_civil_id;
        $dato_general->sexo                 = $request->sexo;
        $dato_general->fecha_registro       = date("Y-m-d");
        $dato_general->nacionalidad_id      = $request->nacionalidad_id;
        $dato_general->email                = $request->email;
        $dato_general->codigo_postal        = $request->codigo_postal;
        $dato_general->save();

        //Image
        if($request->foto){
            $path = Storage::disk('estudiantes')->put('foto',$request->foto);
            $dato_general->fill([ 'foto' => $path ])->save();
        }

        $estudiante = new Estudiante;
        $estudiante->dato_general_id        = $dato_general->id;
        $estudiante->especialidad_id        = $request->especialidad_id;
        $estudiante->estado_estudiante_id   = $request->estado_estudiante_id;
        $estudiante->matricula              = $request->matricula;
        $estudiante->semestre               = 1;
        $estudiante->grupo                  = $request->grupo;
        $estudiante->modalidad_id           = $request->modalidad_id;
        $estudiante->medio_enterado_id      = $request->medio_enterado_id;
        $estudiante->periodo_id             = $periodo->id;
        $estudiante->otros                  = $request->otros;
        $estudiante->usuario_id             = $usuario->id;
        $estudiante->plan_especialidad_id   = $request->plan_especialidad_id;
        $estudiante->save();

        $estudiante->empresa()->attach($request->empresa_id,[
            'puesto'    => $request->puesto
        ]);
        $estudiante->instituto_procedencia()->attach($request->instituto_id);

        if($request->tipo_documento){
            foreach ($request->tipo_documento as $key => $td) {
                if(isset($request->documento[$td])){
                    $path = Storage::disk('estudiantes')->put('documentos',$request->documento[$td]);
                    $estudiante->documento_estudiante()->attach($td,[
                        'documento' => $path
                    ]);
                }else{
                    $estudiante->documento_estudiante()->attach($td);
                }
            }
        }

        return view('private.admin.academicos.estudiantes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show($estudiante)
    {
        // dd(Estudiante::where('dato_general_id',$estudiante)->first());
         return response()->json(Estudiante::where('dato_general_id',$estudiante)->first());
    }
    public function datoGeneral($datoGeneral)
    {
        return response()->json(DatoGeneral::find($datoGeneral));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante)
    {
        $dato_general           = $estudiante->dato_general;
        $localidad              = $dato_general->localidad;
        $municipio              = $localidad->municipio;
        $especialidad           = $estudiante->especialidad;
        $instituto_procedencia  = $estudiante->instituto_procedencia->first();
        $empresa                = $estudiante->empresa->first();
        $grupos = DataTable::estudiantes()->select('grupo')->distinct()->get();

        $documentos_estudiantes = $estudiante->documento_estudiante;
        foreach ($documentos_estudiantes as $key => $documento_estudiante) {
            $documento_estudiante->documento = $documento_estudiante->pivot->documento;
        }

        $estudiante->curp                   = $dato_general->curp;
        $estudiante->nombre                 = $dato_general->nombre;
        $estudiante->apaterno               = $dato_general->apaterno;
        $estudiante->amaterno               = $dato_general->amaterno;
        $estudiante->fecha_nacimiento       = $dato_general->fecha_nacimiento;
        $estudiante->calle_numero           = $dato_general->calle_numero;
        $estudiante->colonia                = $dato_general->colonia;
        $estudiante->localidad_id           = $dato_general->localidad_id;
        $estudiante->telefono_personal      = $dato_general->telefono_personal;
        $estudiante->telefono_casa          = $dato_general->telefono_casa;
        $estudiante->estado_civil_id        = $dato_general->estado_civil_id;
        $estudiante->sexo                   = $dato_general->sexo;
        $estudiante->nacionalidad_id        = $dato_general->nacionalidad_id;
        $estudiante->email                  = $dato_general->email;
        $estudiante->codigo_postal          = $dato_general->codigo_postal;
        $estudiante->foto                   = $dato_general->foto;
        $estudiante->municipio_id           = $localidad->municipio_id;
        $estudiante->estado_id              = $municipio->estado_id;
        $estudiante->nivel_academico_id     = $especialidad->nivel_academico_id;
        $estudiante->empresa_id             = (isset($empresa->id))? $empresa->id:null;
        $estudiante->instituto_id           = (isset($instituto_procedencia->id))? $instituto_procedencia->id:null;
        $estudiante->puesto                 = (isset($empresa->pivot->puesto))? $empresa->pivot->puesto:null;

        return view('private.admin.academicos.estudiantes.edit',[
            'estudiante'                => $estudiante,
            'documentos_estudiantes'    => $documentos_estudiantes,
            'estados_civiles'           => EstadoCivil::orderBy('estado_civil','ASC')->get(),
            'nacionalidades'            => Nacionalidad::orderBy('nacionalidad','ASC')->get(),
            'estados'                   => Estado::orderBy('estado','ASC')->get(),
            'grupos'                    => $grupos,
            'municipios'                => Municipio::where('estado_id',$municipio->estado_id)->orderBy('municipio','ASC')->get(),
            'localidades'               => Localidad::where('municipio_id',$localidad->municipio_id)->orderBy('localidad','ASC')->get(),
            'niveles_academicos'        => NivelAcademico::orderBy('id','ASC')->get(),
            'especialidades'            => Especialidad::where('nivel_academico_id',$especialidad->nivel_academico_id)->orderBy('id','ASC')->get(),
            'planes_especialidades'     => PlanEspecialidad::where('especialidad_id',$especialidad->id)->orderBy('id','ASC')->get(),
            'modalidades_estudiantes'   => ModalidadEstudiante::orderBy('id','ASC')->get(),
            'estados_estudiantes'       => EstadoEstudiante::orderBy('id','ASC')->get(),
            'medios_enterados'          => MedioEnterado::orderBy('id','ASC')->get(),
            'institutos'                => InstitutoProcedencia::orderBy('id','ASC')->get(),
            'empresas'                  => Empresa::orderBy('id','ASC')->get(),
            'tipos_documentos'          => TipoDocumentoEstudiante::orderBy('id','asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Estudiante $estudiante)
    {
        $dato_general = DatoGeneral::find($estudiante->dato_general_id);
        $dato_general->curp                 = $request->curp;
        $dato_general->nombre               = $request->nombre;
        $dato_general->apaterno             = $request->apaterno;
        $dato_general->amaterno             = $request->amaterno;
        $dato_general->fecha_nacimiento     = $request->fecha_nacimiento_submit;
        $dato_general->calle_numero         = $request->calle_numero;
        $dato_general->colonia              = $request->colonia;
        $dato_general->localidad_id         = $request->localidad_id;
        $dato_general->telefono_personal    = $request->telefono_personal;
        $dato_general->telefono_casa        = $request->telefono_casa;
        $dato_general->estado_civil_id      = $request->estado_civil_id;
        $dato_general->sexo                 = $request->sexo;
        $dato_general->nacionalidad_id      = $request->nacionalidad_id;
        $dato_general->email                = $request->email;
        $dato_general->codigo_postal        = $request->codigo_postal;
        $dato_general->save();

        if($request->foto){
            $path = Storage::disk('estudiantes')->put('foto',$request->foto);
            $exists = Storage::disk('estudiantes')->exists($dato_general->foto);
            if($exists){
                Storage::disk('estudiantes')->delete($dato_general->foto);
            }
            $dato_general->fill([ 'foto' => $path ])->save();
        }

        $estudiante->especialidad_id        = $request->especialidad_id;
        $estudiante->estado_estudiante_id   = $request->estado_estudiante_id;
        $estudiante->grupo                  = $request->grupo;
        $estudiante->modalidad_id           = $request->modalidad_id;
        $estudiante->medio_enterado_id      = $request->medio_enterado_id;
        $estudiante->otros                  = $request->otros;
        $estudiante->plan_especialidad_id   = $request->plan_especialidad_id;
        $estudiante->save();

        $empresa = [$request->empresa_id => ['puesto' => $request->puesto]];
        $estudiante->empresa()->sync($empresa);

        $estudiante->instituto_procedencia()->sync($request->instituto_id);        

        $documentos_estudiantes = [];
        if($request->tipo_documento){
            foreach ($request->tipo_documento as $key => $td) {
                if(isset($request->documento[$td])){
                    $path = Storage::disk('estudiantes')->put('documentos',$request->documento[$td]);
                    $documentos_estudiantes[$td] = [ 'documento' => $path];
                }else{
                    $documentos_estudiantes[$td] = $td;
                }
            }
        }
        $result = $estudiante->documento_estudiante()->sync($documentos_estudiantes);
        
        return view('private.admin.academicos.estudiantes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }

    public function searchByName(){
        return view('private.admin.academicos.estudiantes.searchByNames')
                ->with(['datosGenerales' => DatoGeneral::all(),
            'niveles_academicos'        => NivelAcademico::orderBy('id','ASC')->get(),
            'especialidades'            => Especialidad::where('nivel_academico_id',1)->orderBy('id','ASC')->get(),
            'planes_especialidades'     => PlanEspecialidad::where('especialidad_id',1)->orderBy('id','ASC')->get(),
            'grupos' => DataTable::estudiantes()->select('grupo')->distinct()->get(),
            'estados_estudiantes'       => EstadoEstudiante::orderBy('id','ASC')->get(),
            'modalidades_estudiantes'   => ModalidadEstudiante::orderBy('id','ASC')->get(),
            'medios_enterados'          => MedioEnterado::orderBy('id','ASC')->get(),
            'institutos'                => InstitutoProcedencia::orderBy('id','ASC')->get(),
            'empresas'                  => Empresa::orderBy('id','ASC')->get()]);
    }

    public function guardar(Request $request){
        $periodo = Periodo::orderBy('id','desc')->first();

        $usuario = Usuario::where('email', $request -> matricula . '@uniceba.edu.mx')->first();
        // $usuario->email     = $request->matricula.'@uniceba.edu.mx';
        // $usuario->password  = password_hash('secret',PASSWORD_BCRYPT);
        // $usuario->rol_id    = 2;
        // $usuario->save();

        //Image
        if($request->foto){
            $path = Storage::disk('estudiantes')->put('foto',$request->foto);
            $dato_general->fill([ 'foto' => $path ])->save();
        }

        $estudiante = new Estudiante;
        $estudiante->dato_general_id        = $request->dato_general_id;
        $estudiante->especialidad_id        = $request->especialidad_id;
        $estudiante->estado_estudiante_id   = $request->estado_estudiante_id;
        $estudiante->matricula              = $request->matricula;
        $estudiante->semestre               = 1;
        $estudiante->grupo                  = $request->grupo;
        $estudiante->modalidad_id           = $request->modalidad_id;
        $estudiante->medio_enterado_id      = $request->medio_enterado_id;
        $estudiante->periodo_id             = $periodo->id;
        $estudiante->otros                  = $request->otros;
        $estudiante->usuario_id             = $usuario->id;
        $estudiante->plan_especialidad_id   = $request->plan_especialidad_id;
        $estudiante->save();

        $estudiante->empresa()->attach($request->empresa_id,[
            'puesto'    => $request->puesto
        ]);
        $estudiante->instituto_procedencia()->attach($request->instituto_id);

        // if($request->tipo_documento){
        //     foreach ($request->tipo_documento as $key => $td) {
        //         if(isset($request->documento[$td])){
        //             $path = Storage::disk('estudiantes')->put('documentos',$request->documento[$td]);
        //             $estudiante->documento_estudiante()->attach($td,[
        //                 'documento' => $path
        //             ]);
        //         }else{
        //             $estudiante->documento_estudiante()->attach($td);
        //         }
        //     }
        // }
        return response()->json($request);
    }
}
