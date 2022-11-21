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
            $table->id();
            $table->unsignedBigInteger('d-cliente_id');
            $table->string('d-ciudad', 30)->nullable(false);
            $table->string('d-estado', 30)->nullable(false);
            $table->string('d-municipio', 30)->nullable(false);
            $table->integer('d-cp')->nullable(false);
            $table->string('d-colonia', 50)->nullable(false);
            $table->string('d-calle', 50)->nullable(false);
            $table->integer('d-n_exterior')->nullable(false)->default(0);
            $table->integer('d-n_interior')->nullable(false)->default(0);
            $table->timestamps();
            $table->foreign('d-cliente_id')->references('id')->on('clientes')->onDelete('cascade');
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
