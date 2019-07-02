<?php

namespace App\Http\Requests\Admin\TituloDocente;

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
            'titulo' => 'required|unique:titulos,titulo,'.$this->id
        ];
    }

    public function messages()
    {
        return [
            'titulo.required'    => 'El título es requerido.',
            'titulo.unique'      => 'El título ya está en uso.'
        ];
    }
}
