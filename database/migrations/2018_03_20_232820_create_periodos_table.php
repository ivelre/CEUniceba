<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->increments('id');
            $table->year('anio');
            $table->string('periodo',64);
            $table->string('fecha_reconocimiento',64);
            $table->string('reconocimiento_oficial',64)->nullable();
            $table->string('dges',64)->nullable();
            $table->string('jefe_control',200);
            $table->string('director',200);

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
        Schema::dropIfExists('periodos');
    }
}
