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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 50)->nullable(false);
            $table->string('email', 50)->unique()->nullable(false);
            $table->char('telefono', 14)->unique()->nullable(false);
            $table->char('rfc', 13)->unique()->nullable(true);
            $table->string('foto_perfil')->nullable(false)->default('avatar.png');
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
        Schema::dropIfExists('personas');
    }
};
