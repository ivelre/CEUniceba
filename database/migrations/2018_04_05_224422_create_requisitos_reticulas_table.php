<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitosReticulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitos_reticulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reticula_id')->unsigned();
            $table->integer('reticula_requisito_id')->unsigned();

            $table->foreign('reticula_id')->references('id')->on('reticulas')->onDelete('cascade');
            $table->foreign('reticula_requisito_id')->references('id')->on('reticulas');

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
        Schema::dropIfExists('requisitos_reticulas');
    }
}
