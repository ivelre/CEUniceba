<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dato_general_id')->unsigned();
            $table->integer('especialidad_id')->unsigned();
            $table->integer('estado_estudiante_id')->unsigned();
            $table->integer('matricula')->unique();
            $table->string('semestre', 100)->nullable();
            $table->string('semestre_disp', 100)->nullable();
            $table->string('grupo', 100);
            $table->integer('modalidad_id')->unsigned();
            $table->integer('medio_enterado_id')->unsigned();
            $table->integer('periodo_id')->unsigned();
            $table->text('otros')->nullable();
            $table->integer('usuario_id')->unsigned();
            $table->integer('plan_especialidad_id')->unsigned();
            $table->string('clave_pago',100)->nullable();

            $table->foreign('dato_general_id')->references('id')->on('datos_generales');
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
            $table->foreign('estado_estudiante_id')->references('id')->on('estados_estudiantes');
            $table->foreign('modalidad_id')->references('id')->on('modalidades_estudiantes');
            $table->foreign('medio_enterado_id')->references('id')->on('medios_enterados');
            $table->foreign('periodo_id')->references('id')->on('periodos');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
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
        Schema::dropIfExists('estudiantes');
    }
}
