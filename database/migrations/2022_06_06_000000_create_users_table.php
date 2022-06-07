<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->nullable(false);
            $table->string('nombres', 50)->nullable(false);
            $table->string('app', 50)->nullable(false);
            $table->string('apm', 50)->nullable(false);
            $table->string('email', 50)->unique()->nullable(false);
            $table->char('telefono', 10)->unique()->nullable(false);
            $table->char('rfc', 13)->unique()->nullable(true);
            $table->string('colonia', 50)->nullable(false);
            $table->string('calle', 50)->nullable(false);
            $table->integer('n_exterior')->nullable(false);
            $table->integer('n_interior')->nullable(true);
            $table->string('estado', 30)->nullable(true);
            $table->string('municipio', 30)->nullable(true);
            $table->integer('cp')->nullable(true);
            $table->string('nom_user', 20)->nullable(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('es_admin')->nullable(false);
            $table->boolean('estatus')->nullable(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
};
