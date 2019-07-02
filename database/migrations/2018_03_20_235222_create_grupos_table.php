<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clase_id')->unsigned();
            $table->integer('estudiante_id')->unsigned();
            $table->tinyInteger('calificacion')->nullable();
            $table->integer('oportunidad_id')->unsigned();

            $table->foreign('clase_id')->references('id')->on('clases');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('oportunidad_id')->references('id')->on('oportunidades');

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
        Schema::dropIfExists('grupos');
    }
}
