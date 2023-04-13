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
            $table->unsignedBigInteger('persona_id');
            $table->string('ciudad', 30)->nullable(false);
            $table->string('estado', 30)->nullable(false);
            $table->string('municipio', 30)->nullable(false);
            $table->integer('cp')->nullable(false);
            $table->string('colonia', 50)->nullable(false);
            $table->string('calle', 50)->nullable(false);
            $table->integer('n_exterior')->nullable(true)->default(0);
            $table->integer('n_interior')->nullable(true)->default(0);
            $table->timestamps();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
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
