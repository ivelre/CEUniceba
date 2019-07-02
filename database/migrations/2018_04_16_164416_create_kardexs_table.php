<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKardexsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardexs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estudiante_id')->unsigned();
            $table->integer('asignatura_id')->unsigned();
            $table->integer('oportunidad_id')->unsigned();
            $table->tinyInteger('semestre')->nullable();
            $table->integer('periodo_id')->unsigned();
            $table->decimal('calificacion',3,1)->nullable();
            
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');
            $table->foreign('oportunidad_id')->references('id')->on('oportunidades');
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
        Schema::dropIfExists('kardexs');
    }
}
