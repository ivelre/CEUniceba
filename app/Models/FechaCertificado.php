<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FechaCertificado extends Model
{
    protected $table = 'fechas_certificado';
    
    protected $fillable = [
    	'id','fecha_certificado'
    ];
    public $timestamps = false;
}
