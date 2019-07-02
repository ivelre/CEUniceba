<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReticulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reticulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asignatura_id')->unsigned();
            $table->integer('plan_especialidad_id')->unsigned();
            $table->tinyInteger('semestre');
            
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');
            $table->foreign('plan_especialidad_id')->references('id')->on('planes_especialidades');

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
        Schema::dropIfExists('reticulas');
    }
}
