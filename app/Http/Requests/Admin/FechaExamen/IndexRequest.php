<?php

namespace App\Http\Requests\Admin\FechaExamen;

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
            'periodo' => 'required|integer|min:1'
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
            'periodo.required'   => 'El periodo es requerido',
            'periodo.integer'    => 'El periodo tiene que ser un número entero',
            'periodo.min'        => 'El periodo tiene que ser mínimo 1'
        ];
    }
}
