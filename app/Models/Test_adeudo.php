<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test_adeudo extends Model
{
    protected $table = 'temp_adeudos';
    
    protected $fillable = [
    	'id','matricula'
    ];

    public $timestamps = false;

   
}
