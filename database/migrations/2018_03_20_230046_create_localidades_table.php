<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipio_id')->unsigned();
            $table->string('clave',4);
            $table->string('localidad',128);
            $table->string('latitud',16);
            $table->string('longitud',16);
            $table->decimal('lat',10,7);
            $table->decimal('lng',10,7);
            $table->string('altitud',16);
            $table->tinyInteger('activo');

            $table->foreign('municipio_id')->references('id')->on('municipios');
        
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localidades');
    }
}
