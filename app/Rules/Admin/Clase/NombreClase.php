<?php

namespace App\Rules\Admin\Clase;

use App\Models\Clase;

use Illuminate\Contracts\Validation\Rule;

class NombreClase implements Rule
{
    /**
     * ID de la asignatura
     * @var integer asignatura_id
     */
    public $asignatura_id;

    /**
     * ID de la especialidad
     * @var integer especialidad_id
     */
    public $especialidad_id;

    /**
     * ID del periodo
     * @var integer periodo_id
     */
    public $periodo_id;

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
        $this->asignatura_id    = $data['asignatura_id'];
        $this->especialidad_id  = $data['especialidad_id'];
        $this->periodo_id       = $data['periodo_id'];
        if (isset($data['clase_id'])) {
            $this->clase_id     = $data['clase_id'];    
        }
    }

    /**
     * Determina sí el nombre de una clase es valido.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $match = false;

        if($this->clase_id){
            $clases_registradas = Clase::where([
                ['asignatura_id',$this->asignatura_id],
                ['especialidad_id',$this->especialidad_id],
                ['periodo_id',$this->periodo_id],
                ['id','<>',$this->clase_id]
            ])->get();    
        }else{
            $clases_registradas = Clase::where([
                ['asignatura_id',$this->asignatura_id],
                ['especialidad_id',$this->especialidad_id],
                ['periodo_id',$this->periodo_id]
            ])->get();    
        }        
        foreach ($clases_registradas as $key => $clase_registrada) {
            if ($clase_registrada->clase == $value) {
                $match = true;
            }
        }

        if($match){
            return false; 
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El nombre de la clase ya está en uso.';
    }
}
