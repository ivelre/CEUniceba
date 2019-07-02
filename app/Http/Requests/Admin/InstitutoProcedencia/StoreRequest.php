<?php

namespace App\Http\Requests\Admin\InstitutoProcedencia;

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
            'instituto'                 => 'required|unique:institutos_procedencias,institucion',
            'instituto_municipio_id'    => 'required|integer|min:1'
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
            'instituto.required'                => 'El instituto es requerido',
            'instituto.unique'                  => 'El instituto ya ha está registrado',

            'instituto_municipio_id.required'   => 'El municipio es requerido',
            'instituto_municipio_id.integer'    => 'El municipio tiene que ser un número entero',
            'instituto_municipio_id.min'        => 'El municipio tiene que ser mínimo 1'
        ];
    }
}
