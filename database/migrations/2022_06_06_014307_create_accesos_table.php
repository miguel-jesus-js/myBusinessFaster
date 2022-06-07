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
        Schema::create('accesos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nuallable(false);
            $table->unsignedBigInteger('modulo_id')->nuallable(false);
            $table->boolean('c')->nuallable(false);
            $table->boolean('r')->nuallable(false);
            $table->boolean('u')->nuallable(false);
            $table->boolean('d')->nuallable(false);
            $table->boolean('estado')->nuallable(false);
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
        Schema::dropIfExists('accesos');
    }
};
