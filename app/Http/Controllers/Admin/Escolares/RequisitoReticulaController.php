<?php

namespace App\Http\Controllers\Admin\Escolares;

use App\Models\RequisitoReticula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\RequisitoReticula\StoreRequest;

class RequisitoReticulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $requisito_reticula = new RequisitoReticula;

        $requisito_reticula->reticula_id            = $request->reticula_id;
        $requisito_reticula->reticula_requisito_id  = $request->reticula_requisito_id;

        $requisito_reticula->save();
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequisitoReticula  $requisitos_reticula
     * @return \Illuminate\Http\Response
     */
    public function show(RequisitoReticula $requisitos_reticula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequisitoReticula  $requisitos_reticula
     * @return \Illuminate\Http\Response
     */
    public function edit(RequisitoReticula $requisitos_reticula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequisitoReticula  $requisitos_reticula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequisitoReticula $requisitos_reticula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequisitoReticula  $requisitos_reticula
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequisitoReticula $requisitos_reticula)
    {
        $requisitos_reticula->delete();
        return;
    }
}
