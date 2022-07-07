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
        Schema::create('direcciones_entregas', function (Blueprint $table) {
            $table->unsignedBigInteger('cliente_id');
            $table->string('ciudad', 30)->nullable(false);
            $table->string('estado', 30)->nullable(false);
            $table->string('municipio', 30)->nullable(false);
            $table->integer('cp')->nullable(false);
            $table->string('colonia', 50)->nullable(false);
            $table->string('calle', 50)->nullable(false);
            $table->integer('n_exterior')->nullable(false);
            $table->integer('n_interior')->nullable(true);
            $table->timestamps();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direcciones_entregas');
    }
};
