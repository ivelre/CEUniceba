<?php

namespace App\Http\Requests\Admin\FechaExamen;

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
            'tipo_examen_id'    => 'required|integer|min:1',
            'fecha_inicio'      => 'required|date',
            'fecha_final'       => 'required|date|after_or_equal:fecha_inicio'
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
            'tipo_examen_id.required'       => 'El tipo de examen es requerido',
            'tipo_examen_id.integer'        => 'El tipo de examen tiene que ser un número entero',
            'tipo_examen_id.min'            => 'El tipo de examen tiene que ser mínimo 1',

            'fecha_inicio.required'         => 'La fecha de inicio es requerida',
            'fecha_inicio.date'             => 'El dato tiene que ser una fecha',

            'fecha_final.required'          => 'El fecha final es requerida',
            'fecha_final.date'              => 'El dato tiene que ser una fecha',
            'fecha_final.after_or_equal'    => 'La fecha final tiene que ser mayor o igual a la fecha de inicio',
        ];
    }
}
