<?php

namespace App\Http\Controllers\Admin\Configuraciones;

use App\Models\NivelAcademico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\NivelAcademico\StoreRequest;
use App\Http\Requests\Admin\NivelAcademico\UpdateRequest;

class NivelAcademicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.configuraciones.niveles_academicos.index');
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
        $nivel_academico = new NivelAcademico;
        $nivel_academico->nivel_academico       = $request->nivel_academico;
        $nivel_academico->descripcion           = $request->descripcion;
        $nivel_academico->save();
        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NivelAcademico  $niveles_academico
     * @return \Illuminate\Http\Response
     */
    public function show(NivelAcademico $niveles_academico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NivelAcademico  $niveles_academico
     * @return \Illuminate\Http\Response
     */
    public function edit(NivelAcademico $niveles_academico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NivelAcademico  $niveles_academico
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, NivelAcademico $niveles_academico)
    {
        $niveles_academico->nivel_academico     = $request->nivel_academico;
        $niveles_academico->descripcion         = $request->descripcion;
        $niveles_academico->save();
        return ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NivelAcademico  $niveles_academico
     * @return \Illuminate\Http\Response
     */
    public function destroy(NivelAcademico $niveles_academico)
    {
        $niveles_academico->delete();
    }
}
