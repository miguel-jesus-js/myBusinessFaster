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
            $table->unsignedBigInteger('tipo_cliente_id')->nullable(false);
            $table->string('nombres', 50)->nullable(false);
            $table->string('app', 50)->nullable(false);
            $table->string('apm', 50)->nullable(false);
            $table->string('email', 50)->unique()->nullable(false);
            $table->char('telefono', 14)->unique()->nullable(false);
            $table->char('rfc', 13)->unique()->nullable(true);
            $table->string('empresa', 50)->nullable(true);
            $table->string('ciudad', 30)->nullable(false);
            $table->string('estado', 30)->nullable(false);
            $table->string('municipio', 30)->nullable(false);
            $table->string('colonia', 50)->nullable(false);
            $table->string('calle', 50)->nullable(false);
            $table->integer('n_exterior')->nullable(true)->default(0);
            $table->integer('n_interior')->nullable(true)->default(0);
            $table->integer('cp')->nullable(false);
            $table->string('password')->nullable(false);
            $table->double('limite_credito', 8, 2)->nullable(true)->default(0);
            $table->integer('dias_credito')->nullable(true)->default(0);
            $table->boolean('verificado')->default(false)->nullable(false);
            $table->timestamps();
            $table->softdeletes();
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
