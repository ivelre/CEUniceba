<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asignatura_id')->unsigned();
            $table->string('clase',16);
            $table->integer('docente_id')->unsigned();
            $table->integer('especialidad_id')->unsigned();
            $table->integer('periodo_id')->unsigned();
            
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
            $table->foreign('periodo_id')->references('id')->on('periodos');

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
        Schema::dropIfExists('clases');
    }
}
