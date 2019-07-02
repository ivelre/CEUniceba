<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoEstudiante extends Model
{
    protected $table = 'documentos_estudiantes';
    
    protected $fillable = [
    	'estudiante_id','tipo_documento_id','documento'
    ];

    public $timestamps = false;

    public function estudiante(){
    	return $this->belongsTo('App\Models\Estudiante','estudiante_id');
    }

    public function tipo_documento(){
    	return $this->belongsTo('App\Models\TipoDocumentoEstudiante','tipo_documento_id');
    }
}
