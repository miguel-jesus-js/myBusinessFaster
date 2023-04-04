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
            $table->float('pre_compra')->nullable(false);
            $table->float('pre_venta')->nullable(false);
            $table->float('pre_mayoreo')->nullable(false);
            $table->float('utilidad')->nullable(false);
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
