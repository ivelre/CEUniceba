<?php

namespace App\Http\Controllers\Admin\Configuraciones;

use App\Models\Oportunidad;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Oportunidad\StoreRequest;
use App\Http\Requests\Admin\Oportunidad\UpdateRequest;

class OportunidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.admin.configuraciones.oportunidades.index');
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
        $oportunidade = new Oportunidad;
        $oportunidade->oportunidad      = $request->oportunidad;
        $oportunidade->descripcion      = $request->descripcion;
        $oportunidade->save();
        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Oportunidad  $oportunidade
     * @return \Illuminate\Http\Response
     */
    public function show(Oportunidad $oportunidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Oportunidad  $oportunidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Oportunidad $oportunidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Oportunidad  $oportunidade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Oportunidad $oportunidade)
    {
        $oportunidade->oportunidad      = $request->oportunidad;
        $oportunidade->descripcion      = $request->descripcion;
        $oportunidade->save();
        return ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Oportunidad  $oportunidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oportunidad $oportunidade)
    {
        $oportunidade->delete();
        return ;
    }
}
