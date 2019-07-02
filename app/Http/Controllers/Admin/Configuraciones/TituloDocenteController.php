<?php

namespace App\Http\Controllers\Admin\Configuraciones;

use App\Models\Titulo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\TituloDocente\StoreRequest;
use App\Http\Requests\Admin\TituloDocente\UpdateRequest;

class TituloDocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.configuraciones.titulos_docentes.index');
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
        $titulo = new Titulo;
        $titulo->titulo         = $request->titulo;
        $titulo->descripcion    = $request->descripcion;
        $titulo->save();
        
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Titulo  $titulos_docente
     * @return \Illuminate\Http\Response
     */
    public function show(Titulo $titulos_docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Titulo  $titulos_docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Titulo $titulos_docente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Titulo  $titulos_docente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Titulo $titulos_docente)
    {
        $titulos_docente->titulo        = $request->titulo;
        $titulos_docente->descripcion   = $request->descripcion;
        $titulos_docente->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Titulo  $titulos_docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Titulo $titulos_docente)
    {
        $titulos_docente->delete();
    }
}
