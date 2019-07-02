<?php

namespace App\Http\Controllers\Admin\Academicos;

use App\Models\Kardex;
use App\Models\Grupo;
use App\Models\Estudiante;
use App\Models\Reticula;
use App\Models\Periodo;
use App\Models\Oportunidad;
use App\Models\FechaCertificado;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Kardex\IndexRequest;

class KardexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $estudiante = Estudiante::find($request->estudiante);
        return view('private.admin.academicos.kardex.index',[
            'estudiante' => $estudiante
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verEstudiante($matricula)
    {
        $fechas = FechaCertificado::all();
        foreach ($fechas as $key => $fecha)
            $fechas[$key] -> fecha = $this -> obtenerFechaEnLetra($fecha -> fecha_certificado);
        return view('private.admin.academicos.kardex.cargarCalificaciones',['estudiantes' => Estudiante::all(),'oportunidades' => Oportunidad::all(),'periodos' => Periodo::all(),'fechas_certificado' => $fechas,'matricula' => $matricula]);
    }

    public function newKardexElemente(Request $req){
        $kardex = kardex::find($req->id);
        if(!$kardex)
            $kardex = new Kardex;

        $kardex -> estudiante_id = $req -> estudiante_id;
        $kardex -> asignatura_id = $req -> asignatura_id;
        $kardex -> oportunidad_id = $req -> oportunidad_id;
        $kardex -> semestre = $req -> semestre;
        $kardex -> periodo_id = $req -> periodo_id;
        $kardex -> calificacion = $req -> calificacion;

        $kardex -> save();
    }

    public function deleteKardexElemente(Request $req){
        $kardex = Kardex::find($req -> id);
        // dd($kardex);
        if($kardex -> grupo_id != null){
            $grupo = Grupo::find($kardex -> grupo_id);
            if($grupo)
                $grupo -> delete();
        }
        $kardex -> delete();
    }

    public function expedienteKardex(Request $req){
        $estudiante = Estudiante::find($req -> id);

        $estudiante -> fecha = $req -> fecha;
        $estudiante -> folio = $req -> folio;
        $estudiante -> expediente = $req -> expediente;

        $estudiante -> save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        foreach ($input as $key => $calificacion) {
            $kardex = Kardex::where('estudiante_id',$calificacion['estudiante_id'])->where('asignatura_id',$calificacion['asignatura_id'])->first();
            if(!$kardex)
                $kardex = new Kardex;

            $kardex -> estudiante_id = $calificacion['estudiante_id'];
            $kardex -> asignatura_id = $calificacion['asignatura_id'];
            $kardex -> oportunidad_id = $calificacion['oportunidad_id'];
            $kardex -> semestre = $calificacion['semestre'];
            $kardex -> periodo_id = $calificacion['periodo_id'];
            $kardex -> calificacion = $calificacion['calificacion'];

            $kardex -> save();
        }
        return 'Terminado';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function show($kardex)
    {
        return response()->json(
            Estudiante::
            select('estudiantes.id as estudiante_id','matricula','fecha','folio','expediente','nombre','apaterno','amaterno','semestre','estado_estudiante','especialidad','plan_especialidad_id','nivel_academico_id')
            ->join('datos_generales','datos_generales.id','estudiantes.dato_general_id')
            ->join('estados_estudiantes','estados_estudiantes.id','estudiantes.estado_estudiante_id')
            ->join('especialidades','especialidades.id','estudiantes.especialidad_id')
            ->where('matricula',$kardex)
            ->first());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function getCalificaciones($estudiante_id)
    {
        return response()->json(Reticula::select('anio','asignatura','kardexs.asignatura_id','calificacion','codigo','creditos','descripcion','kardexs.estudiante_id','fecha_reconocimiento','kardexs.id','oportunidad','kardexs.oportunidad_id','periodo','kardexs.periodo_id','periodo_reticula','plan_especialidad_id','prioridad','semestre')
            ->join('asignaturas','asignaturas.id','reticulas.asignatura_id')
            ->join('kardexs','kardexs.asignatura_id','reticulas.asignatura_id')
            // ->join('grupos','grupos.clase_id','clases.id')
            ->join('oportunidades','oportunidades.id','kardexs.oportunidad_id')
            ->join('periodos','periodos.id','kardexs.periodo_id')
            ->where('estudiante_id',$estudiante_id)
            ->orderby('asignaturas.codigo','asc')
            ->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function getReticulaPlan($plan_especialidad_id)
    {
        return response()->json(Reticula::join('asignaturas','asignaturas.id','reticulas.asignatura_id')
            //->join('kardexs','kardexs.asignatura_id','asignaturas.id')
            ->where('plan_especialidad_id',$plan_especialidad_id)
            //->where('estudiante_id',$estudiante_id)
            ->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function edit(Kardex $kardex)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kardex $kardex)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kardex $kardex)
    {
        //
    }

    function obtenerFechaEnLetra($fecha){
        $num = date("j", strtotime($fecha));
        $ano = date("Y", strtotime($fecha));
        $mes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        $mes = $mes[(date('m', strtotime($fecha))*1)-1];
        return $num.' DE '.$mes.' DE '.$ano;
    }
}
