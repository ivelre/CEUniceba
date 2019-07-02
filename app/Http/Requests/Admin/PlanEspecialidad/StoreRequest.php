<?php

namespace App\Http\Requests\Admin\PlanEspecialidad;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'plan_especialidad' => 'required|unique:planes_especialidades,plan_especialidad',        
            'periodos'          => 'required|integer|min:1',
            'especialidad_id'   => 'required|integer|min:1'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'plan_especialidad.required'    => 'El plan de estudio es requerido',
            'plan_especialidad.unique'      => 'El plan de estudio ya ha está en uso',

            'periodos.required'             => 'El número de periodos es requerido',
            'periodos.integer'              => 'El número de periodos tiene que ser un número entero',
            'periodos.min'                  => 'El número de periodos tiene que ser mínimo 1',

            'especialidad_id.required'      => 'La especialidad es requerida',
            'especialidad_id.integer'       => 'La especialidad tiene que ser un número entero',
            'especialidad_id.min'           => 'La especialidad tiene que ser mínimo 1'
        ];
    }
}
