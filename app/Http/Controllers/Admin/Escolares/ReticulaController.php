<?php

namespace App\Http\Controllers\Admin\Escolares;

use App\Models\Reticula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Reticula\StoreRequest;

class ReticulaController extends Controller
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
        $reticula = new Reticula;

        $reticula->plan_especialidad_id     = $request->plan_especialidad_id;
        $reticula->asignatura_id            = $request->asignatura_id;
        $reticula->periodo_reticula         = $request->periodo_reticula;

        $reticula->save();
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reticula  $reticula
     * @return \Illuminate\Http\Response
     */
    public function show(Reticula $reticula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reticula  $reticula
     * @return \Illuminate\Http\Response
     */
    public function edit(Reticula $reticula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reticula  $reticula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reticula $reticula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reticula  $reticula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reticula $reticula)
    {
        $reticula->delete();
        return ;
    }
}
