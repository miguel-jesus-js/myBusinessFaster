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
        Schema::create('productos_sucursal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sucursale_id')->nullable(false);
            $table->unsignedBigInteger('producto_id')->nullable(false);
            $table->integer('stock')->nullable(false);
            $table->decimal('pre_compra', 8, 2)->nullable(false);
            $table->decimal('pre_venta', 8, 2)->nullable(false);
            $table->decimal('pre_mayoreo', 8, 2)->nullable(false);
            $table->decimal('pre_credito', 8, 2)->nullable(false);
            $table->decimal('utilidad', 8, 2)->nullable(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sucursale_id')->references('id')->on('sucursales')->onDelete('cascade');
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
        Schema::dropIfExists('productos_sucursal');
    }
};
