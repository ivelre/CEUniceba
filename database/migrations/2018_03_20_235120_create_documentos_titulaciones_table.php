<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTitulacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_titulaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_documento_id')->unsigned();
            $table->integer('titulo_id')->unsigned();
            $table->string('documento',255)->nullable();
            
            $table->foreign('tipo_documento_id')->references('id')->on('tipos_documentos_titulaciones');
            $table->foreign('titulo_id')->references('id')->on('titulaciones');

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
        Schema::dropIfExists('documentos_titulaciones');
    }
}
