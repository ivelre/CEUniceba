<?php

namespace App\Http\Requests\Admin\Asignatura;

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
            'asignatura'    => 'required',
            'codigo'        => 'required|unique:asignaturas,codigo',
            'creditos'      => 'required|integer|min:1'
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
            'asignatura.required'   => 'La asignatura es requerida',

            'codigo.required'       => 'El código es requerido',
            'codigo.unique'         => 'Este código ya está en uso',
            
            'creditos.required'     => 'El número de creditos es requerido',
            'creditos.integer'      => 'El número de creditos tiene que ser un número entero',
            'creditos.min'          => 'El número de creditos mínimos es 1'
        ];
    }
}
