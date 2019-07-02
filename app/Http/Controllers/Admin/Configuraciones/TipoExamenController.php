<?php

namespace App\Http\Controllers\Admin\Configuraciones;

use App\Models\TipoExamen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\TipoExamen\StoreRequest;
use App\Http\Requests\Admin\TipoExamen\UpdateRequest;

class TipoExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.configuraciones.tipos_examenes.index');
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
        $tipo_examen = new TipoExamen;
        $tipo_examen->tipo_examen       = $request->tipo_examen;
        $tipo_examen->descripcion       = $request->descripcion;
        $tipo_examen->save();
        
        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoExamen  $tipos_examene
     * @return \Illuminate\Http\Response
     */
    public function show(TipoExamen $tipos_examene)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoExamen  $tipos_examene
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoExamen $tipos_examene)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoExamen  $tipos_examene
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, TipoExamen $tipos_examene)
    {
        $tipos_examene->tipo_examen     = $request->tipo_examen;
        $tipos_examene->descripcion     = $request->descripcion;
        $tipos_examene->save();

        return ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoExamen  $tipos_examene
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoExamen $tipos_examene)
    {
        $tipos_examene->delete();
        return;
    }
}
