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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(true);
            $table->string('nombre', 50)->nullable(false);
            $table->char('telefono', 14)->unique()->nullable(true);
            $table->string('correo', 100)->unique()->nullable(true);
            $table->string('rfc', 13)->unique()->nullable(true);
            $table->string('ciudad', 30)->nullable(true);
            $table->string('estado', 30)->nullable(true);
            $table->string('municipio', 30)->nullable(true);
            $table->string('colonia', 50)->nullable(true);
            $table->string('calle', 50)->nullable(true);
            $table->integer('n_exterior')->nullable(true)->default(0);
            $table->integer('n_interior')->nullable(true)->default(0);
            $table->integer('cp')->nullable(true);
            // $table->boolean('mostrar_sidebar')->nullable(true)->default(true);
            // $table->boolean('mostrar_banner')->nullable(true)->default(true);
            // $table->boolean('mostrar_foto')->nullable(true)->default(true);
            $table->string('facebook', 200)->nullable(true);
            $table->string('twitter', 200)->nullable(true);
            $table->string('instagram', 200)->nullable(true);
            $table->string('tiktok', 200)->nullable(true);
            $table->string('whatsapp', 200)->unique()->nullable(true);
            $table->string('mensaje', 255)->nullable(true);
            $table->boolean('esta_configurado')->nullable(false)->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursales');
    }
};
