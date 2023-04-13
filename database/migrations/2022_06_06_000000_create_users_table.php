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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id')->nullable(false);
            $table->unsignedBigInteger('role_id')->nullable(false);
            $table->string('nom_user', 30)->unique(true)->nullable(false);
            $table->boolean('mostrar_sidebar')->nullable(true)->default(true);
            $table->boolean('mostrar_banner')->nullable(true)->default(true);
            $table->boolean('mostrar_foto')->nullable(true)->default(true);
            $table->string('api_token')->nullable(true);
            $table->string('password')->nullable(false);
            $table->boolean('is_admin')->nullable(false)->default(false);
            $table->boolean('estatus')->nullable(false)->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
