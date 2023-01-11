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
            $table->unsignedBigInteger('user_id')->nullable(true);
            $table->unsignedBigInteger('cliente_id')->nullable(true);
            $table->bigInteger('folio')->nullable(false);
            $table->datetime('fecha')->nullable(false);
            $table->decimal('importe', 8, 2)->nullable(false);
            $table->decimal('iva', 8, 2)->nullable(false);
            $table->decimal('descuento', 8, 2)->nullable(false);
            $table->decimal('total', 8, 2)->nullable(false);
            $table->decimal('pago_con', 8, 2)->nullable(false);
            $table->string('tipo_pago', 20)->nullable(false);
            $table->boolean('estado')->nullable(false);
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('documentos');
    }
};
