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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materiale_id');
            $table->unsignedBigInteger('unidad_medida_id');
            $table->unsignedBigInteger('marca_id');
            $table->char('cod_barra', 13)->unique()->nullable(false);
            $table->string('producto', 100)->nullable(false);
            $table->float('pre_compra')->nullable(false);
            $table->float('pre_venta')->nullable(false);
            $table->float('pre_mayoreo')->nullable(false);
            $table->float('utilidad')->nullable(false);
            $table->integer('stock_min')->nullable(false);
            $table->integer('stock')->nullable(false);
            $table->string('img', 100)->nullable(true);
            $table->date('caducidad')->nullable(true);
            $table->string('color', 50)->nullable(true);
            $table->string('talla', 15)->nullable(true);
            $table->string('desc_detallada', 200)->nullable(true);
            $table->boolean('es_produccion')->nullable(false)->default(false);
            $table->boolean('afecta_ventas')->nullable(false)->default(true);
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('materiale_id')->references('id')->on('materiales')->onDelete('cascade');
            $table->foreign('unidad_medida_id')->references('id')->on('unidad_medidas')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
