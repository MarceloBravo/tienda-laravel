<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut',13)->unique();
            $table->string('nombre',50);
            $table->string('a_paterno',50);
            $table->string('a_materno',50);
            $table->string('email')->unique();
            $table->string('nickname',20);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('direccion');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
