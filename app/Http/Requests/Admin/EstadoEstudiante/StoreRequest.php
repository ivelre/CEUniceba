<?php

namespace App\Http\Requests\Admin\EstadoEstudiante;

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
            'estado_estudiante' => 'required|unique:estados_estudiantes,estado_estudiante'
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
            'estado_estudiante.required'    => 'El estado del estudiante es requerido.',
            'estado_estudiante.unique'      => 'El estado del estudiante ya está en uso.'
        ];
    }
}
