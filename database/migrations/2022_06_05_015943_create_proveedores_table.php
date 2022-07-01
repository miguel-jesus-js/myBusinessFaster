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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('clave', 10)->nullable(false)->unique();
            $table->string('nombres', 50)->nullable(false);
            $table->string('app', 50)->nullable(false);
            $table->string('apm', 50)->nullable(false);
            $table->string('email', 50)->unique()->nullable(false);
            $table->char('telefono', 14)->unique()->nullable(false);
            $table->char('rfc', 13)->unique()->nullable(false);
            $table->string('empresa', 50)->nullable(true);
            $table->string('ciudad', 30)->nullable(true);
            $table->string('estado', 30)->nullable(true);
            $table->string('municipio', 30)->nullable(true);
            $table->integer('cp')->nullable(true);
            $table->string('colonia', 50)->nullable(false);
            $table->string('calle', 50)->nullable(false);
            $table->integer('n_exterior')->nullable(false);
            $table->integer('n_interior')->nullable(true);
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
};
