<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';
    
    protected $fillable = [
        'dato_general_id','especialidad_id','estado_estudiante_id','matricula','semestre','grupo','modalidad_id','medio_enterado_id','periodo_id','otros','usuario_id','plan_especialidad_id'
    ];

    public $timestamps = false;

    public function getSemestres() {
        $kardex = \DB::table('kardexs')
            ->select(
            'kardexs.periodo_id',
            'asignaturas.codigo',
            'asignaturas.asignatura',
            'kardexs.calificacion',
            'oportunidades.id as oportunidad_id',
            'oportunidades.oportunidad',
            'reticulas.periodo_reticula',
            'periodos.periodo',
            'periodos.anio',
            'kardexs.estudiante_id',
            'estudiantes.fecha',
            'estudiantes.folio',
            'estudiantes.expediente'
            )
            // ->join('grupos','grupos.id','kardexs.grupo_id')
            // ->join('clases','clases.id','grupos.clase_id')
            ->join('estudiantes', 'estudiantes.id', '=', 'kardexs.estudiante_id')
            ->join('asignaturas', 'asignaturas.id', '=', 'kardexs.asignatura_id')
            ->join('oportunidades', 'oportunidades.id', '=', 'kardexs.oportunidad_id')
            ->leftjoin('periodos', 'periodos.id', '=', 'kardexs.periodo_id')
            ->join('reticulas', 'reticulas.asignatura_id', '=', 'kardexs.asignatura_id')
            ->where('estudiante_id',$this->id)
            ->orderBy('periodo_reticula','asc')
            ->orderBy('oportunidades.prioridad','asc')
            ->get();

            // dd($kardex);

        $semestres = [];
        foreach ($kardex as $k_item) {

            switch ($k_item->oportunidad_id) {
                case 3:$tipo_examen = 2 ;break;
                case 7:$tipo_examen = 3 ;break;
                default:$tipo_examen = 1 ;break;
            }
            $fecha_examen = \DB::table('fechas_examenes')->where('tipo_examen_id',$tipo_examen)->where('periodo_id',$k_item -> periodo_id)->first();
            // if($k_item->codigo == 'LD0521')
            //     dd($k_item->oportunidad_id);

            $materia = new \StdClass;
            $materia->clave = $k_item->codigo;
            $materia->nombre_asignatura = $k_item->asignatura;
            $materia->oportunidad = $k_item->oportunidad;
            $materia->fecha_examen = (isset($fecha_examen->fecha_inicio))?$fecha_examen -> fecha_inicio:null;
            $materia->fecha = $k_item->fecha;
            $materia->folio = $k_item->folio;
            $materia->expediente = $k_item->expediente;
            $materia->calificacion = (int)($k_item->calificacion);
            $materia->calificacion_letra = $this->num2let((int)($k_item->calificacion));
            $materia->observaciones = '';

            $materia->ciclo = $k_item -> periodo;
            // if(($k_item->periodo / 10) < 10) {
            //     $materia->ciclo = '0' . (int)($k_item->periodo / 10) . '/' . $k_item->periodo%10;
            // }else{
            //     $materia->ciclo = (int)($k_item->periodo / 10) . '/' . $k_item->periodo%10;
            // }

            $semestres[$this->nombreSemestre($k_item->periodo_reticula)][$k_item->codigo] = $materia;
        }

        return $semestres;
    }

    public function nombreSemestre($numero) {
        switch ($numero) {
            case 1: return 'Primer Semestre';
            case 2: return 'Segundo Semestre';
            case 3: return 'Tercer Semestre';
            case 4: return 'Cuarto Semestre';
            case 5: return 'Quinto Semestre';
            case 6: return 'Sexto Semestre';
            case 7: return 'Séptimo Semestre';
            case 8: return 'Octavo Semestre';
            case 9: return 'Noveno Semestre';
            case 10: return 'Décimo Semestre';
            default: return 'Semestre extra';
        }
    }

    public function num2let($numero) {
        switch ($numero) {
            case 1: return 'UNO';
            case 2: return 'DOS';
            case 3: return 'TRES';
            case 4: return 'CUATRO';
            case 5: return 'CINCO';
            case 6: return 'SEIS';
            case 7: return 'SIETE';
            case 8: return 'OCHO';
            case 9: return 'NUEVE';
            case 10: return 'DIEZ';
            default:
                return 'N/A';
        }
    }

    static function getDatosBoleta($estudiante_id){
        return \DB::table('estudiantes')
                ->join('especialidades','especialidades.id','estudiantes.especialidad_id')
                ->join('niveles_academicos','niveles_academicos.id','especialidades.nivel_academico_id')
                ->join('datos_generales','datos_generales.id','estudiantes.dato_general_id')
                ->where('estudiantes.id',$estudiante_id)
                ->first();
    }

    static function getDatosActa($estudiante_id){
        return \DB::table('estudiantes')
                ->join('especialidades','especialidades.id','estudiantes.especialidad_id')
                ->join('niveles_academicos','niveles_academicos.id','especialidades.nivel_academico_id')
                ->join('datos_generales','datos_generales.id','estudiantes.dato_general_id')
                ->join('periodos','periodos.id','estudiantes.periodo_id')
                ->join('estados_civiles','estados_civiles.id','datos_generales.estado_civil_id')
                ->join('nacionalidades','nacionalidades.id','datos_generales.nacionalidad_id')
                ->join('localidades','localidades.id','datos_generales.localidad_id')
                ->join('municipios','municipios.id','localidades.municipio_id')
                ->join('estados','estados.id','municipios.estado_id')
                ->join('modalidades_estudiantes','modalidades_estudiantes.id','estudiantes.modalidad_id')
                ->join('medios_enterados','medios_enterados.id','estudiantes.medio_enterado_id')
                ->leftjoin('estudiantes_trabajos','estudiantes_trabajos.estudiante_id','estudiantes.id')
                ->leftjoin('empresas','empresas.id','estudiantes_trabajos.empresa_id')
                ->where('estudiantes.id',$estudiante_id)
                ->first();
    }

    public function getDatosGenerales() {
        return $this->hasOne('\App\Models\DatoGeneral', 'id', 'dato_general_id');
    }

    public function getEspecialidad() {
        return $this->hasOne('\App\Models\Especialidad', 'id', 'especialidad_id');
    }

    // Relaciones
    public function empresa(){
        return $this->belongsToMany('App\Models\Empresa','estudiantes_trabajos','estudiante_id','empresa_id')
            ->withPivot('puesto');
    }

    public function documento_estudiante(){
    	return $this->belongsToMany('App\Models\TipoDocumentoEstudiante','documentos_estudiantes','estudiante_id','tipo_documento_id')
            ->withPivot('documento');
    }

    public function instituto_procedencia(){
        return $this->belongsToMany('App\Models\InstitutoProcedencia','procedencias_estudiantes','estudiante_id','instituto_id');
    }

    public function equivalencias(){
        return $this->hasMany('App\Models\Equivalencia','estudiante_id');
    }

    public function titulaciones(){
    	return $this->hasMany('App\Models\Titulacion','estudiante_id');
    }

    public function grupos(){
    	return $this->hasMany('App\Models\Grupo','estudiante_id');
    }

    public function kardexs(){
        return $this->hasMany('App\Models\Kardex','estudiante_id');
    }

    public function dato_general(){
    	return $this->belongsTo('App\Models\DatoGeneral','dato_general_id');
    }

	public function especialidad(){
    	return $this->belongsTo('App\Models\Especialidad','especialidad_id');
    }

    public function estado_estudiante(){
    	return $this->belongsTo('App\Models\EstadoEstudiante','estado_estudiante_id');
    }

    public function modalidad(){
    	return $this->belongsTo('App\Models\ModalidadEstudiante','modalidad_id');
    }

    public function medio_enterado(){
    	return $this->belongsTo('App\Models\MedioEnterado','medio_enterado_id');
    }

    public function periodo(){
    	return $this->belongsTo('App\Models\Periodo','periodo_id');
    }

    public function usuario(){
    	return $this->belongsTo('App\Models\Usuario','usuario_id');
    }

    public function plan_especialidad(){
        return $this->belongsTo('App\Models\PlanEspecialidad','plan_especialidad_id');
    }    

}
