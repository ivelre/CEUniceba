<?php

namespace App\Http\Requests\Admin\Estudiante;

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
            //Datos Generales
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

            'especialidad_id'           => 'required|integer|min:1',
            'plan_especialidad_id'      => 'required|integer|min:1',
            'grupo'                     => 'required',
            'estado_estudiante_id'      => 'required|integer|min:1',
            'modalidad_id'              => 'required|integer|min:1',

            'medio_enterado_id'         => 'required|integer|min:1',
            'instituto_id'              => 'required|integer|min:1',
            'empresa_id'                => 'required|integer|min:1',

        ];

        if($this->foto){
            $rules = array_merge($rules,[
                'foto'  => 'mimes:jpg,jpeg,png'
            ]);
        }

        if($this->tipo_documento){
            $rules = array_merge($rules,[
                'tipo_documento.*'  => 'integer|min:1'
            ]);
            foreach ($this->tipo_documento as $key => $td) {
                if(isset($this->documento[$td])){
                    $rules = array_merge($rules,[
                        'documento.'.$td  => 'mimes:jpg,jpeg,png'
                    ]);
                }
            }
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
            //Datos Generales

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

            //Especificos

            'especialidad_id.required'          => 'La especialidad es requerida.',
            'especialidad_id.integer'           => 'La especialidad tiene que ser un número entero.',
            'especialidad_id.min'               => 'La especialidad minima es 1.',

            'plan_especialidad_id.required'     => 'El plan de estudio es requerido.',
            'plan_especialidad_id.integer'      => 'El plan de estudio tiene que ser un número entero.',
            'plan_especialidad_id.min'          => 'El plan de estudio minimo es 1.',

            'grupo.required'                    => 'El grupo es requerido.',

            'estado_estudiante_id.required'     => 'El estado del estudiante es requerido.',
            'estado_estudiante_id.integer'      => 'El estado del estudiante tiene que ser un número entero.',
            'estado_estudiante_id.min'          => 'El estado del estudiante minimo es 1.',
            
            'modalidad_id.required'             => 'La modalidad es requerida.',
            'modalidad_id.integer'              => 'La modalidad tiene que ser un número entero.',
            'modalidad_id.min'                  => 'La modalidad minima es 1.',
            
            //Referencias

            'medio_enterado_id.required'        => 'El medio de enterado es requerido.',
            'medio_enterado_id.integer'         => 'El medio de enterado tiene que ser un número entero.',
            'medio_enterado_id.min'             => 'El medio de enterado minimo es 1.',

            'instituto_id.required'             => 'El instituto de procedencia es requerido.',
            'instituto_id.integer'              => 'El instituto de procedencia tiene que ser un número entero.',
            'instituto_id.min'                  => 'El instituto de procedencia minimo es 1.',

            'empresa_id.required'               => 'La empresa es requerida.',
            'empresa_id.integer'                => 'La empresa tiene que ser un número entero.',
            'empresa_id.min'                    => 'La empresa minima es 1.'
        ];

        
        
        if($this->foto){
            $messages = array_merge($messages,[
                'foto.mimes'  => 'El archivo no es una imagen'
            ]);
        }

        

        if($this->tipo_documento){
            $messages = array_merge($messages,[
                'tipo_documento.*.integer'  => 'El tipo de documento tiene que ser un número entero.'
            ]);
            $messages = array_merge($messages,[
                'tipo_documento.*.min'  => 'El tipo de documento minimo es 1.'
            ]);
            foreach ($this->tipo_documento as $key => $td) {
                if(isset($this->documento[$td])){
                    $messages = array_merge($messages,[
                        'documento.*.mimes'  => 'El archivo no es una imagen'
                    ]);
                }
            }
        }

        return $messages;
    }
}
