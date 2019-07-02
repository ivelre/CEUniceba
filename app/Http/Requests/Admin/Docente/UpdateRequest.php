<?php

namespace App\Http\Requests\Admin\Docente;

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
        $rules = [
            'nombre'                    => 'required',
            'apaterno'                  => 'required',
            'amaterno'                  => 'required',
            'curp'                      => 'required',
            'fecha_nacimiento_submit'   => 'required|date',
            'estado_civil_id'           => 'required|integer|min:1',
            'sexo'                      => 'required|in:F,M,O',
            'nacionalidad_id'           => 'required|integer|min:1',
            'calle_numero'              => 'required',
            'colonia'                   => 'required',
            'codigo_postal'             => 'required|integer',
            'localidad_id'              => 'required|integer|min:1',
            'codigo'                    => 'required|unique:docentes,codigo,'.$this->id,
            'rfc'                       => 'required|unique:docentes,rfc,'.$this->id,
            'titulo_id'                 => 'required|integer|min:1'
        ];

        if($this->foto){
            $rules = array_merge($rules,[
                'foto'  => 'mimes:jpg,jpeg,png'
            ]);
        }
        return $rules;
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        $messages = [
            'nombre.required'                   => 'El nombre es requerido.',
            
            'apaterno.required'                 => 'El apellido paterno es requerido.',
            
            'amaterno.required'                 => 'El apellido materno es requerido.',

            'curp.required'                     => 'El CURP es requerido.',
            'curp.unique'                       => 'Este CURP ya está en uso.',
            
            'fecha_nacimiento_submit.required'  => 'La fecha de nacimiento es requerido.',
            'fecha_nacimiento_submit.date'      => 'El tipo de dato tiene que ser fecha.',

            'estado_civil_id.required'          => 'El estado civil es requerido.',
            'estado_civil_id.integer'           => 'El estado civil tiene que ser un número entero.',
            'estado_civil_id.min'               => 'El estado civil mínimo es 1.',

            'sexo.required'                     => 'El sexo es requerido.',
            'sexo.in'                           => 'Los valores solo pueden ser ["F","M","O"].',

            'nacionalidad_id.required'          => 'La nacionalidad es requerida.',
            'nacionalidad_id.integer'           => 'La nacionalidad tiene que ser un número entero.',
            'nacionalidad_id.min'               => 'La nacionalidad mínimo es 1.',

            'calle_numero.required'             => 'La calle y número es requerida.',

            'colonia.required'                  => 'La colonia es requerida.',

            'codigo_postal.required'            => 'El código postal es requerido.',
            'codigo_postal.integer'             => 'El código postal tiene que ser un número.',

            'localidad_id.required'             => 'La localidad es requerida.',
            'localidad_id.integer'              => 'La localidad tiene que ser un número entero.',
            'localidad_id.min'                  => 'La localidad minima es 1.',

            'codigo.required'                   => 'El código es requerido.',
            'codigo.unique'                     => 'Este código ya está en uso.',

            'rfc.required'                      => 'El RFC es requerido.',
            'rfc.unique'                        => 'Este rfc ya está en uso.',
            
            'titulo_id.required'                => 'El título es requerido.',  
            'titulo_id.integer'                 => 'El título tiene que ser un número entero.',
            'titulo_id.min'                     => 'El título mínimo es 1.'
        ];

        if($this->get('foto')){
            $messages = array_merge($messages,[
                'foto.mimes'  => 'El archivo no es una imagen'
            ]);
        }

        return $messages;
    }
}
