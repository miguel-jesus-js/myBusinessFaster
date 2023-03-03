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
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id')->nullable(false);
            $table->unsignedBigInteger('producto_id')->nullable(false);
            $table->decimal('precio', 8, 2)->nullable(false);
            $table->integer('cantidad')->nullable(false);
            $table->decimal('importe', 8, 2)->nullable(false);
            $table->timestamps();
            $table->foreign('ventas_id')->references('id')->on('ventas')->onDelete('cascade');
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
        Schema::dropIfExists('detalles');
    }
};
