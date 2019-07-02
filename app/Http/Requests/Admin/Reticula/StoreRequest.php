<?php

namespace App\Http\Requests\Admin\Reticula;

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
            'plan_especialidad_id'  => 'required|integer|min:1',
            'asignatura_id'         => 'required|integer|min:1',
            'periodo_reticula'      => 'required|integer|min:1'
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
            'plan_especialidad_id.required' => 'El plan de estudios es requerido',
            'plan_especialidad_id.integer'  => 'El plan de estudios tiene que ser un número entero',
            'plan_especialidad_id.min'      => 'El plan de estudios tiene que ser mínimo 1',

            'asignatura_id.required'        => 'La asignatura es requerida',
            'asignatura_id.integer'         => 'La asignatura tiene que ser un número entero',
            'asignatura_id.min'             => 'La asignatura tiene que ser mínimo 1',

            'periodo_reticula.required'     => 'El período es requerido',
            'periodo_reticula.integer'      => 'La período tiene que ser un número entero',
            'periodo_reticula.min'          => 'La período tiene que ser mínimo 1'
        ];
    }
}
