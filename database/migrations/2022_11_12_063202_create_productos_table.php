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
            $table->unsignedBigInteger('marca_id')->nullable(true);
            $table->unsignedBigInteger('almacene_id')->nullable(true);
            $table->unsignedBigInteger('unidad_medida_id')->nullable(true);
            $table->unsignedBigInteger('proveedore_id')->nullable(true);
            $table->unsignedBigInteger('materiale_id')->nullable(true);
            $table->char('cod_barra', 13)->unique()->nullable(false);
            $table->char('cod_sat', 8)->unique()->nullable(true);
            $table->string('producto', 50)->nullable(false);
            $table->float('pre_compra')->nullable(false);
            $table->float('pre_venta')->nullable(false);
            $table->float('pre_mayoreo')->nullable(false);
            $table->float('utilidad')->nullable(false);
            $table->integer('stock_min')->nullable(false);
            $table->integer('stock')->nullable(false);
            $table->string('img1', 100)->nullable(true);
            $table->string('img2', 100)->nullable(true);
            $table->string('img3', 100)->nullable(true);
            $table->date('caducidad')->nullable(true);
            $table->string('color', 50)->nullable(true);
            $table->string('talla', 15)->nullable(true);
            $table->string('modelo', 30)->nullable(true);
            $table->integer('meses_garantia')->nullable(true)->default(0);
            $table->decimal('peso_kg', 4,2)->nullable(true)->default(0);
            $table->string('desc_detallada', 200)->nullable(true);
            $table->boolean('es_produccion')->nullable(false)->default(false);
            $table->boolean('afecta_ventas')->nullable(false)->default(true);
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('almacene_id')->references('id')->on('almacenes')->onDelete('cascade');
            $table->foreign('unidad_medida_id')->references('id')->on('unidad_medidas')->onDelete('cascade');
            $table->foreign('proveedore_id')->references('id')->on('proveedores')->onDelete('cascade');
            $table->foreign('materiale_id')->references('id')->on('materiales')->onDelete('cascade');
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
