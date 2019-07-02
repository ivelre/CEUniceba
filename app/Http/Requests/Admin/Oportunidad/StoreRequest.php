<?php

namespace App\Http\Requests\Admin\Oportunidad;

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
            'oportunidad' => 'required|unique:oportunidades,oportunidad'
        ];
    }

    public function messages()
    {
        return [
            'oportunidad.required'    => 'La oportunidad es requerida.',
            'oportunidad.unique'      => 'La oportunidad ya está en uso.'
        ];
    }
}
