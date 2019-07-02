<?php

namespace App\Http\Requests\Admin\PlanEspecialidad;

use App\Models\PlanEspecialidad;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $plan_especialidad = PlanEspecialidad::find($this->id);
        $reticulas = $plan_especialidad->reticulas;

        $periodo_min = 1;
        foreach ($reticulas as $key => $reticula) {
            if ($reticula->periodo_reticula > $periodo_min) {
                $periodo_min = $reticula->periodo_reticula;
            }
        }

        $rules = [
            'plan_especialidad' => 'required|unique:planes_especialidades,plan_especialidad,'.$this->id,        
            'periodos'          => 'required|integer|min:'.$periodo_min
        ];

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $plan_especialidad = PlanEspecialidad::find($this->id);
        $reticulas = $plan_especialidad->reticulas;

        $periodo_min = 1;
        foreach ($reticulas as $key => $reticula) {
            if ($reticula->periodo_reticula > $periodo_min) {
                $periodo_min = $reticula->periodo_reticula;
            }
        }

        $messages = [
            'plan_especialidad.required'    => 'El plan de estudio es requerido',
            'plan_especialidad.unique'      => 'El plan de estudio ya ha está en uso',

            'periodos.required'             => 'El número de periodos es requerido',
            'periodos.integer'              => 'El número de periodos tiene que ser un número entero',
            'periodos.min'                  => 'El número de periodos tiene que ser mínimo '.$periodo_min
        ];

        return $messages;
    }
}
