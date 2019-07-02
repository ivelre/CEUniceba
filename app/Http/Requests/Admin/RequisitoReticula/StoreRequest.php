<?php

namespace App\Http\Requests\Admin\RequisitoReticula;

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
            'reticula_id'           => 'required|integer|min:1',
            'reticula_requisito_id' => 'required|integer|min:1'
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
            'reticula_id.required'              => 'La reticula es requerida',
            'reticula_id.integer'               => 'La reticula tiene que ser un número entero',
            'reticula_id.min'                   => 'La reticula tiene que ser mínimo 1',

            'reticula_requisito_id.required'    => 'La reticula de requisito es requerida',
            'reticula_requisito_id.integer'     => 'La reticula de requisito tiene que ser un número entero',
            'reticula_requisito_id.min'         => 'La reticula de requisito tiene que ser mínimo 1'
        ];
    }
}
