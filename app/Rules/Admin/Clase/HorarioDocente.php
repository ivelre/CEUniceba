<?php

namespace App\Rules\Admin\Clase;

use App\Models\Clase;

use Illuminate\Contracts\Validation\Rule;

class HorarioDocente implements Rule
{
    /**
     * Array con los días seleccionados.
     * @var array dia
     */
    public $dia;

    /**
     * Array con las horas de entrada.
     * @var array hora_entrada
     */
    public $hora_entrada;

    /**
     * Array con las horas de salida.
     * @var array hora_salida
     */
    public $hora_salida;

    /**
     * ID del período.
     * @var integer periodo_id
     */
    public $periodo_id;

    /**
     * ID del docente.
     * @var integer docente_id
     */
    public $docente_id;

    /**
     * ID de la clase
     * @var integer clase_id
     */
    public $clase_id;

    /**
     * Materia con la que hay cruce.
     * @var string materia.
     */
    public $materia;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($validate)
    {
        $this->dia             = $validate['dia'];
        $this->hora_entrada    = $validate['hora_entrada'];
        $this->hora_salida     = $validate['hora_salida'];
        $this->periodo_id      = $validate['periodo_id'];
        $this->docente_id      = $validate['docente_id'];        

        if (isset($validate['clase_id'])) {
            $this->clase_id    = $validate['clase_id'];
        }
    }

    /**
     * Determina que el docente no tenga cruce de horario con otras clases
     * asignadas en el mismo periodo.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $horario_valido = true;

        if ($this->clase_id) {
            $clases_docente = Clase::where([
                ['docente_id',  $this->docente_id],
                ['periodo_id',  $this->periodo_id],
                ['id','<>',     $this->clase_id]
            ])->get();    
        }else{
            $clases_docente = Clase::where([
                ['docente_id',  $this->docente_id],
                ['periodo_id',  $this->periodo_id]
            ])->get();
        }
        
        $horarios_docente = [];
        foreach ($clases_docente as $key => $clase_docente) {
            $horarios = $clase_docente->horarios;
            foreach ($horarios as $key => $horario) {
                array_push($horarios_docente,$horario);
            }
        }

        if($this->dia){

            foreach ($this->dia as $key => $dia_id) {
            
                if (isset($this->hora_entrada[$dia_id]) && isset($this->hora_salida[$dia_id])) {
                        
                    foreach ($horarios_docente as $key_h => $horario_docente) {
    
                        if ( ($horario_docente->dia_id - 1) == $dia_id ) {
    
                            $hora_entrada_request   = date("H:i:s", strtotime($this->hora_entrada[$dia_id]));
                            $hora_salida_request    = date("H:i:s", strtotime($this->hora_salida[$dia_id]));
    
                            $hora_entrada_docente   = date("H:i:s", strtotime($horario_docente->hora_entrada));
                            $hora_salida_docente    = date("H:i:s", strtotime($horario_docente->hora_salida));
    
                            if( $hora_entrada_request >= $hora_entrada_docente &&
                                $hora_entrada_request < $hora_salida_docente){
    
                                $asignatura = $horario_docente->clase->asignatura->asignatura;
                                $especialidad = $horario_docente->clase->especialidad->especialidad;
                                $clase = $horario_docente->clase->clase;
    
                                $this->materia = $asignatura.' ['. $clase .'] - '.$especialidad;
                                $horario_valido = false ;  
                            } 
                            if( $hora_salida_request > $hora_entrada_docente &&
                                $hora_salida_request <= $hora_salida_docente){
    
                                $asignatura = $horario_docente->clase->asignatura->asignatura;
                                $especialidad = $horario_docente->clase->especialidad->especialidad;
                                $clase = $horario_docente->clase->clase;
    
                                $this->materia = $asignatura.' ['. $clase .'] - '.$especialidad;
                                $horario_valido = false ;
                            }
                            if( $hora_entrada_request <= $hora_entrada_docente &&
                                $hora_salida_request >= $hora_salida_docente){
    
                                $asignatura = $horario_docente->clase->asignatura->asignatura;
                                $especialidad = $horario_docente->clase->especialidad->especialidad;
                                $clase = $horario_docente->clase->clase;
    
                                $this->materia = $asignatura.' ['. $clase .'] - '.$especialidad;
                                $horario_valido = false;
                            }
                        }
                    }
                }
            }
        }

        return $horario_valido;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El docente tiene cruce de horarios con: '.$this->materia ;
    }
}
