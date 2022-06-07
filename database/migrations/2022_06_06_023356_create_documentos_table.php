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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_documento_id')->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(true);
            $table->unsignedBigInteger('cliente_id')->nullable(true);
            $table->unsignedBigInteger('proveedore_id')->nullable(true);
            $table->bigInteger('folio')->nullable(false);
            $table->datetime('fecha')->nullable(false);
            $table->float('importe')->nullable(false);
            $table->float('iva')->nullable(false);
            $table->float('total')->nullable(false);
            $table->string('tipo_pago', 40)->nullable(false);
            $table->string('desc', 200)->nullable(true);
            $table->boolean('estado')->nullable(false);
            $table->timestamps();
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documentos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('proveedore_id')->references('id')->on('proveedores')->onDelete('cascade');
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
