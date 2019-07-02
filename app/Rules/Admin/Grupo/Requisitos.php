<?php

namespace App\Rules\Admin\Grupo;

use App\Models\Estudiante;
use App\Models\Clase;
use App\Models\Reticula;
use App\Models\Kardex;

use Illuminate\Contracts\Validation\Rule;

class Requisitos implements Rule
{
    /**
     * ID del estudiante
     * @var integer estudiante_id
     */
    public $estudiante_id;

    /**
     * ID de la clase
     * @var integer clase_id
     */
    public $clase_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->estudiante_id  = $data['estudiante_id'];
        $this->clase_id       = $data['clase_id'];
    }

    /**
     * Determina sí un alumno cumple con los requísitos para ser inscrito
     * en un grupo.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $requisitos_reticula = true;
        $estudiante = Estudiante::find($this->estudiante_id);
        $clase = Clase::find($this->clase_id);
        $reticula = Reticula::where([
            ['asignatura_id',$clase->asignatura_id],
            ['plan_especialidad_id',$estudiante->plan_especialidad_id],
        ])->first();
        $requisitos = $reticula->requisitos;
        
        
        foreach ($requisitos as $key_requisito => $requisito) {

            $kardexs = Kardex::where([
                ['estudiante_id',$estudiante->id],
                ['asignatura_id',$requisito->asignatura_id]
            ])->get();

            if($kardexs){
                $max_calificacion = 0;

                foreach ($kardexs as $key_kardex => $kardex) {
                    if($kardex->calificacion >= $max_calificacion){
                        $max_calificacion = $kardex->calificacion;
                    }
                }
                if ($max_calificacion < 7) {
                    $requisitos_reticula = false;
                }

            }else{
                $requisitos_reticula = false;
            }

        }

        return $requisitos_reticula;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El estudiante no cumple con los requisitos.';
    }
}
