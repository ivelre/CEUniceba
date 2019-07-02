<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitulacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titulaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_id')->unsigned();
            $table->integer('estudiante_id')->unsigned();
            $table->date('fecha_inicio');
            $table->string('observaciones',255)->nullable();
            $table->integer('estado_id')->unsigned();

            $table->foreign('tipo_id')->references('id')->on('tipos_titulaciones');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('estado_id')->references('id')->on('estados_titulaciones');

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
        Schema::dropIfExists('titulaciones');
    }
}
