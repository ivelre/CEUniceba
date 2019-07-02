<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesEspecialidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes_especialidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plan_especialidad',32);
            $table->tinyInteger('semestres');
            $table->integer('especialidad_id')->unsigned();
            $table->integer('coordinador_id')->unsigned();
            $table->string('descripcion',255)->nullable();
            
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
            $table->foreign('coordinador_id')->references('id')->on('docentes');

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
        Schema::dropIfExists('planes_especialidades');
    }
}
