<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rol_id')->unsigned();
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->bigInteger('pantalla_id')->unsigned();
            $table->foreign('pantalla_id')->references('id')->on('pantallas');
            $TABLE->boolean('acceder')->default(false);
            $table->boolean('crear')->default(false);
            $table->boolean('actualizar')->dafult(false);
            $table->boolean('eliminar')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}
