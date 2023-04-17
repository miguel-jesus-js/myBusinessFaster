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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('cliente_id')->nullable(true);
            $table->unsignedBigInteger('sucursale_id')->nullable(false);
            $table->unsignedBigInteger('direcciones_entrega_id')->nullable(true);
            $table->bigInteger('folio')->nullable(false);
            $table->datetime('fecha')->nullable(false);
            $table->decimal('importe', 8, 2)->nullable(false);
            $table->decimal('iva', 8, 2)->nullable(false);
            $table->decimal('descuento', 8, 2)->nullable(false);
            $table->decimal('total', 8, 2)->nullable(false);
            $table->decimal('paga_con', 8, 2)->nullable(false);
            $table->enum('tipo_pago', ['Efectivo', 'Tarjeta'])->nullable(false);
            $table->enum('estado', ['Pagado', 'Pendiente'])->nullable(false);
            $table->enum('tipo_venta', ['Venta a menudeo', 'Venta a mayoreo'])->nullable(false);
            $table->enum('tipo_venta_pago', ['Venta normal', 'Venta a crédito'])->nullable(false);
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('sucursale_id')->references('id')->on('sucursales')->onDelete('cascade');
            $table->foreign('direcciones_entrega_id')->references('id')->on('direcciones_entregas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
