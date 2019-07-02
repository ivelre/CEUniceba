<?php

namespace App\Http\Requests\Admin\TipoExamen;

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
            'tipo_examen' => 'required|unique:tipos_examenes,tipo_examen,'.$this->id
        ];
    }

    public function messages()
    {
        return [
            'tipo_examen.required'    => 'El tipo de examen es requerido.',
            'tipo_examen.unique'      => 'El tipo de examen ya está en uso.'
        ];
    }
}
