<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoTitulacion extends Model
{
    protected $table = 'documentos_titulaciones';
    
    protected $fillable = [
    	'titulo_id','tipo_documento_id','documento'
    ];

    public $timestamps = false;

    public function titulacion(){
        return $this->belongsTo('App\Models\Titulacion','titulo_id');
    }

    public function tipos_documentos(){
        return $this->belongsTo('App\Models\TiposDocumentosTitulacion','tipo_documento_id');
    }
}
