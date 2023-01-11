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
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->id();
            $table->string('logotipo', 100)->nullable(true);
            $table->string('razon_social', 50)->nullable(true);
            $table->char('telefono', 14)->nullable(true);
            $table->char('correo', 100)->nullable(true);
            $table->string('rfc', 13)->nullable(true);
            $table->string('direccion', 200)->nullable(true);
            $table->char('color', 7)->nullable(true);
            $table->boolean('mostrar_sidebar')->nullable(true)->default(true);
            $table->boolean('mostrar_banner')->nullable(true)->default(true);
            $table->boolean('mostrar_foto')->nullable(true)->default(true);
            $table->string('facebook', 200)->nullable(true);
            $table->string('twitter', 200)->nullable(true);
            $table->string('instagram', 200)->nullable(true);
            $table->string('tiktok', 200)->nullable(true);
            $table->string('whatsapp', 200)->nullable(true);
            $table->string('mensaje', 255)->nullable(true);
            $table->boolean('esta_configurado')->nullable(false)->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuraciones');
    }
};
