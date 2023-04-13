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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id')->nullable(false);
            $table->unsignedBigInteger('tipo_cliente_id')->nullable(false);
            $table->string('empresa', 50)->nullable(true);
            $table->double('limite_credito', 8, 2)->nullable(true)->default(0);
            $table->integer('dias_credito')->nullable(true)->default(0);
            $table->string('api_token')->nullable(true);
            $table->string('password')->nullable(false);
            $table->boolean('estatus')->nullable(false)->default(true);
            $table->boolean('tele_verificado')->nullable(false)->default(false);
            $table->boolean('correo_verificado')->nullable(false)->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('tipo_cliente_id')->references('id')->on('tipo_clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
