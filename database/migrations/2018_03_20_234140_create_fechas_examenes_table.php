<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechasExamenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas_examenes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_examen_id')->unsigned();
            $table->date('fecha')->nullable();
            $table->integer('periodo_id')->unsigned();
            $table->string('descripcion',255)->nullable();

            $table->foreign('tipo_examen_id')->references('id')->on('tipos_examenes');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');

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
        Schema::dropIfExists('fechas_examenes');
    }
}
