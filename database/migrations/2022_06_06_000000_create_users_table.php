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
            $table->unsignedBigInteger('sucursale_id')->nullable(false);
            $table->unsignedBigInteger('role_id')->nullable(false);
            $table->string('nombres', 50)->nullable(false);
            $table->string('app', 50)->nullable(false);
            $table->string('apm', 50)->nullable(false);
            $table->string('email', 50)->unique()->nullable(false);
            $table->char('telefono', 14)->unique()->nullable(false);
            $table->char('rfc', 13)->unique()->nullable(true);
            $table->string('ciudad', 30)->nullable(true);
            $table->string('estado', 30)->nullable(true);
            $table->string('municipio', 30)->nullable(true);
            $table->integer('cp')->nullable(true);
            $table->string('colonia', 50)->nullable(false);
            $table->string('calle', 50)->nullable(false);
            $table->integer('n_exterior')->nullable(true)->default(0);
            $table->integer('n_interior')->nullable(true)->default(0);
            $table->string('nom_user', 20)->unique()->nullable(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foto_perfil')->nullable(false)->default('avatar.png');
            $table->boolean('estatus')->nullable(false)->default(true);
            $table->boolean('mostrar_sidebar')->nullable(true)->default(true);
            $table->boolean('mostrar_banner')->nullable(true)->default(true);
            $table->boolean('mostrar_foto')->nullable(true)->default(true);
            $table->boolean('isAdmin')->nullable(false)->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('sucursale_id')->references('id')->on('sucursales')->onDelete('cascade');
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
