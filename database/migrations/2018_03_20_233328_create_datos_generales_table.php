<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_generales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('curp',18)->nullable();
            $table->string('nombre',64)->nullable();
            $table->string('apaterno',64)->nullable();
            $table->string('amaterno',64)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('calle_numero',200)->nullable();
            $table->string('colonia',200)->nullable();
            $table->integer('codigo_postal')->unsigned()->nullable();
            $table->integer('localidad_id')->unsigned();
            $table->string('telefono_casa')->nullable();
            $table->string('telefono_personal')->nullable();
            $table->integer('estado_civil_id')->unsigned();
            $table->enum('sexo',['H','M','O'])->nullable();
            $table->date('fecha_registro')->nullable();
            $table->integer('nacionalidad_id')->unsigned();
            $table->string('email',200)->nullable();
            $table->text('foto')->nullable();
            $table->foreign('localidad_id')->references('id')->on('localidades');
            $table->foreign('estado_civil_id')->references('id')->on('estados_civiles');
            $table->foreign('nacionalidad_id')->references('id')->on('nacionalidades');

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
        Schema::dropIfExists('datos_generales');
    }
}
