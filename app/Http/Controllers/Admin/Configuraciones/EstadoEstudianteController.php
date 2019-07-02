<?php

namespace App\Http\Controllers\Admin\Configuraciones;

use App\Models\EstadoEstudiante;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\EstadoEstudiante\StoreRequest;
use App\Http\Requests\Admin\EstadoEstudiante\UpdateRequest;

class EstadoEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.configuraciones.estados_estudiantes.index');
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
        $estado_estudiante = new EstadoEstudiante;
        $estado_estudiante->estado_estudiante   = $request->estado_estudiante;
        $estado_estudiante->descripcion         = $request->descripcion;
        $estado_estudiante->save();
        
        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EstadoEstudiante  $estados_estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(EstadoEstudiante $estados_estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EstadoEstudiante  $estados_estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(EstadoEstudiante $estados_estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EstadoEstudiante  $estados_estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, EstadoEstudiante $estados_estudiante)
    {
        $estados_estudiante->estado_estudiante   = $request->estado_estudiante;
        $estados_estudiante->descripcion         = $request->descripcion;
        $estados_estudiante->save();
        
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstadoEstudiante  $estados_estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstadoEstudiante $estados_estudiante)
    {
        $estados_estudiante->delete();
    }
}
