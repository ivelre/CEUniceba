<?php

namespace App\Http\Controllers\Admin\Escolares;

use App\Models\PlanEspecialidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\PlanEspecialidad\IndexRequest;
use App\Http\Requests\Admin\PlanEspecialidad\StoreRequest;
use App\Http\Requests\Admin\PlanEspecialidad\UpdateRequest;

class PlanEspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        return view('private.admin.escolares.planes_especialidades.index',[
            'especialidad' => $request->especialidad,
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
        $plan_epecialidad = new PlanEspecialidad;
        $plan_epecialidad->plan_especialidad    = $request->plan_especialidad;
        $plan_epecialidad->periodos             = $request->periodos;
        $plan_epecialidad->especialidad_id      = $request->especialidad_id;
        $plan_epecialidad->descripcion          = $request->descripcion;

        $plan_epecialidad->save();
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanEspecialidad  $planes_especialidade
     * @return \Illuminate\Http\Response
     */
    public function show(PlanEspecialidad $planes_especialidade)
    {
        return $planes_especialidade;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanEspecialidad  $planes_especialidade
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanEspecialidad $planes_especialidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlanEspecialidad  $planes_especialidade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, PlanEspecialidad $planes_especialidade)
    {
        $planes_especialidade->plan_especialidad    = $request->plan_especialidad;
        $planes_especialidade->periodos             = $request->periodos;
        $planes_especialidade->descripcion          = $request->descripcion;

        $planes_especialidade->save();
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanEspecialidad  $planes_especialidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanEspecialidad $planes_especialidade)
    {
        $planes_especialidade->delete();
    }
}
