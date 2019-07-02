<?php

namespace App\Http\Requests\Admin\NivelAcademico;

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
            'nivel_academico' => 'required|unique:niveles_academicos,nivel_academico'
        ];
    }

    public function messages()
    {
        return [
            'nivel_academico.required'    => 'El nivel académico es requerido.',
            'nivel_academico.unique'      => 'El nivel académico ya está en uso.'
        ];
    }
}
