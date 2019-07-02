<?php

namespace App\Http\Controllers\Admin\Escolares;

use App\Models\Especialidad;
use App\Models\NivelAcademico;
use App\Models\ModalidadEspecialidad;
use App\Models\TipoPlanEspecialidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Especialidad\StoreRequest;
use App\Http\Requests\Admin\Especialidad\UpdateRequest;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.escolares.especialidades.index',[
            'niveles_academicos'            => NivelAcademico::         orderBy('id','ASC')->get(),
            'modalidades_especialidades'    => ModalidadEspecialidad::  orderBy('id','ASC')->get(),
            'tipos_planes_especialidades'   => TipoPlanEspecialidad::   orderBy('id','ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $especialidad = new Especialidad;

        $especialidad->nivel_academico_id           = $request->nivel_academico_id;
        $especialidad->clave                        = $request->clave;
        $especialidad->especialidad                 = $request->especialidad;
        $especialidad->reconocimiento_oficial       = $request->reconocimiento_oficial;
        $especialidad->dges                         = $request->dges;
        $especialidad->fecha_reconocimiento         = $request->fecha_reconocimiento;
        $especialidad->descripcion                  = $request->descripcion;
        $especialidad->modalidad_id                 = $request->modalidad_id;
        $especialidad->tipo_plan_especialidad_id    = $request->tipo_plan_especialidad_id;

        $especialidad->save();
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Especialidad  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function show(Especialidad $especialidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Especialidad  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Especialidad $especialidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Especialidad  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $especialidad)
    {
        $especialidade = Especialidad::find($especialidad);
        $especialidade->nivel_academico_id           = $request->nivel_academico_id;
        $especialidade->clave                        = $request->clave;
        $especialidade->especialidad                 = $request->especialidad;
        $especialidade->reconocimiento_oficial       = $request->reconocimiento_oficial;
        $especialidade->dges                         = $request->dges;
        $especialidade->fecha_reconocimiento         = $request->fecha_reconocimiento;
        $especialidade->descripcion                  = $request->descripcion;
        $especialidade->modalidad_id                 = $request->modalidad_id;
        $especialidade->tipo_plan_especialidad_id    = $request->tipo_plan_especialidad_id;

        $especialidade->save();
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Especialidad  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Especialidad $especialidade)
    {
        //
    }
}
