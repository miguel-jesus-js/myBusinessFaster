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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id')->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->dateTime('fecha_estimada')->nullable(false);
            $table->dateTime('fecha_hora')->nullable(false);
            $table->decimal('anticipo', 8, 2)->nullable(false);
            $table->decimal('monto', 8, 2)->nullable(false);
            $table->decimal('paga_con', 8, 2)->nullable(false);
            $table->decimal('cambio', 8, 2)->nullable(false);
            $table->integer('estado')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
};
