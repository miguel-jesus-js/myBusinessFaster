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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('sucursale_id')->nullable(false);
            $table->unsignedBigInteger('almacene_id')->nullable(true);
            $table->unsignedBigInteger('producto_id')->nullable(false);
            $table->datetime('fecha')->nullable(false);
            $table->integer('cantidad')->nullable(false);
            $table->integer('tipo')->nullable(false);
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sucursale_id')->references('id')->on('sucursales')->onDelete('cascade');
            $table->foreign('almacene_id')->references('id')->on('almacenes')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventarios');
    }
};
