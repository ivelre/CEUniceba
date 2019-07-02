<?php

namespace App\Http\Requests\Admin\Kardex;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'estudiante' => 'required|integer|min:1'
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
            'estudiante.required'   => 'El estudiante es requerido',
            'estudiante.integer'    => 'El estudiante tiene que ser un número entero',
            'estudiante.min'        => 'El estudiante tiene que ser mínimo 1'
        ];
    }
}
