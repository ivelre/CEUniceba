<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutosProcedenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutos_procedencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institucion',128);
            $table->integer('municipio_id')->unsigned();
            
            $table->foreign('municipio_id')->references('id')->on('municipios');

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
        Schema::dropIfExists('institutos_procedencias');
    }
}
