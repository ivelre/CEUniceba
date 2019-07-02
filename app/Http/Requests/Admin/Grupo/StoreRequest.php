<?php

namespace App\Http\Requests\Admin\Grupo;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Admin\Grupo\Requisitos;

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
        $rules = [
            'requisitos'        => [
                'required',
                new Requisitos([
                    'estudiante_id' => $this->estudiante_id,
                    'clase_id'      => $this->clase_id,
                ])
            ],
            'clase_id'          => 'required|integer|min:1',
            'estudiante_id'     => 'required|integer|min:1',
            'oportunidad_id'    => 'required|integer|min:1'
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
        return [
            'requisitos.required'       => 'El requisito es requerido',

            'clase_id.required'         => 'La clase es requerida',
            'clase_id.integer'          => 'La clase tiene que ser un número entero',
            'clase_id.min'              => 'La clase mínima es 1.',

            'estudiante_id.required'    => 'El estudiante es requerido.',
            'estudiante_id.integer'     => 'El estudiante tiene que ser un número entero.',
            'estudiante_id.min'         => 'El estudiante mínimos es 1.',

            'oportunidad_id.required'   => 'La oportunidad es requerida.',
            'oportunidad_id.integer'    => 'La oportunidad tiene que ser un número entero.',
            'oportunidad_id.min'        => 'La oportunidad mínima es 1.'
        ];
    }
}
