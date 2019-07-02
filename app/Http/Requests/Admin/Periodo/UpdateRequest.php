<?php

namespace App\Http\Requests\Admin\Periodo;

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
        return [
            'anio'                          => 'required|integer|min:2000',
            'periodo'                       => 'required',
            'reconocimiento_oficial'        => 'required|unique:periodos,reconocimiento_oficial,'.$this->id,
            'dges'                          => 'required|unique:periodos,dges,'.$this->id,
            'fecha_reconocimiento_submit'   => 'required|date'
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
            'anio.required'                         => 'El año es requerido',
            'anio.integer'                          => 'El año tiene que ser un número entero',
            'anio.min'                              => 'El año tiene que ser mínimo 2000',

            'periodo.required'                      => 'El período es requerido',

            'reconocimiento_oficial.required'       => 'El reconocimiento oficial es requerido',
            'reconocimiento_oficial.unique'         => 'El reconocimiento oficial ya ha está en uso',

            'dges.unique'                           => 'El DGES es requerido',
            'dges.unique'                           => 'El DGES ya está en uso',

            'fecha_reconocimiento_submit.required'  => 'La fecha de reconocimiento es requerida',
            'fecha_reconocimiento_submit.date'      => 'El dato tiene que ser una fecha'
        ];
    }
}
