<?php

namespace App\Http\Controllers\Admin\Academicos;

use App\Models\Docente;
use App\Models\EstadoCivil;
use App\Models\Nacionalidad;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Localidad;
use App\Models\Titulo;
use App\Models\Usuario;
use App\Models\DatoGeneral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\Admin\Docente\StoreRequest;
use App\Http\Requests\Admin\Docente\UpdateRequest;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.academicos.docentes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.admin.academicos.docentes.create',[
            'estados_civiles'   => EstadoCivil::orderBy('estado_civil','ASC')->get(),
            'nacionalidades'    => Nacionalidad::orderBy('nacionalidad','ASC')->get(),
            'estados'           => Estado::orderBy('estado','ASC')->get(),
            'municipios'        => Municipio::where('estado_id',11)->orderBy('municipio','ASC')->get(),
            'localidades'       => Localidad::where('municipio_id',327)->orderBy('localidad','ASC')->get(),
            'titulos'           => Titulo::orderBy('id','ASC')->get()
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
        $usuario = new Usuario;
        $usuario->email     = $request->codigo.'@uniceba.edu.mx';
        $usuario->password  = password_hash('secret',PASSWORD_BCRYPT);
        $usuario->rol_id    = 3;
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
            $path = Storage::disk('docentes')->put('foto',$request->foto);
            $dato_general->fill([ 'foto' => $path ])->save();
        }

        $docente = new Docente;
        $docente->codigo            = $request->codigo;
        $docente->dato_general_id   = $dato_general->id;
        $docente->rfc               = $request->rfc;
        $docente->titulo_id         = $request->titulo_id;
        $docente->usuario_id        = $usuario->id;
        $docente->save();
        return view('private.admin.academicos.docentes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        $dato_general   = $docente->dato_general;
        $localidad      = $dato_general->localidad;
        $municipio      = $localidad->municipio;
        
        $docente->curp                 = $dato_general->curp;
        $docente->nombre               = $dato_general->nombre;
        $docente->apaterno             = $dato_general->apaterno;
        $docente->amaterno             = $dato_general->amaterno;
        $docente->fecha_nacimiento     = $dato_general->fecha_nacimiento;
        $docente->calle_numero         = $dato_general->calle_numero;
        $docente->colonia              = $dato_general->colonia;
        $docente->localidad_id         = $dato_general->localidad_id;
        $docente->telefono_personal    = $dato_general->telefono_personal;
        $docente->telefono_casa        = $dato_general->telefono_casa;
        $docente->estado_civil_id      = $dato_general->estado_civil_id;
        $docente->sexo                 = $dato_general->sexo;
        $docente->nacionalidad_id      = $dato_general->nacionalidad_id;
        $docente->email                = $dato_general->email;
        $docente->codigo_postal        = $dato_general->codigo_postal;
        $docente->foto                 = $dato_general->foto;
        $docente->municipio_id         = $localidad->municipio_id;
        $docente->estado_id            = $municipio->estado_id;

        return view('private.admin.academicos.docentes.edit',[
            'docente'           => $docente,
            'estados_civiles'   => EstadoCivil::orderBy('estado_civil','ASC')->get(),
            'nacionalidades'    => Nacionalidad::orderBy('nacionalidad','ASC')->get(),
            'estados'           => Estado::orderBy('estado','ASC')->get(),
            'municipios'        => Municipio::where('estado_id',$municipio->estado_id)->orderBy('municipio','ASC')->get(),
            'localidades'       => Localidad::where('municipio_id',$localidad->municipio_id)->orderBy('localidad','ASC')->get(),
            'titulos'           => Titulo::orderBy('id','ASC')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Docente $docente)
    {
        $usuario = Usuario::find($docente->usuario_id);
        $usuario->email     = $request->codigo.'@uniceba.edu.mx';
        $usuario->save();

        $dato_general = DatoGeneral::find($docente->dato_general_id);
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

        //Image
        if($request->foto){
            $path = Storage::disk('docentes')->put('foto',$request->foto);
            $exists = Storage::disk('docentes')->exists($dato_general->foto);
            if($exists){
                Storage::disk('docentes')->delete($dato_general->foto);
            }
            $dato_general->fill([ 'foto' => $path ])->save();
        }

        $docente->codigo            = $request->codigo;
        $docente->rfc               = $request->rfc;
        $docente->titulo_id         = $request->titulo_id;
        $docente->save();
        return view('private.admin.academicos.docentes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        $usuario         = $docente->usuario;
        $dato_general    = $docente->dato_general;
        $docente->delete();
        Usuario::find($usuario->id)->delete();
        
        $exists = Storage::disk('docentes')->exists($dato_general->foto);
        if($exists){
            Storage::disk('docentes')->delete($dato_general->foto);
        }
        DatoGeneral::find($dato_general->id)->delete();
        return;
    }
}
