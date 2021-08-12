<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id');
            $table->foreignId('lugar_pago_id');

            $table->string('email', 40);
            $table->string('nombre', 30)->nullable();
            $table->string('apellido', 30)->nullable();
            $table->bigInteger('cuix');

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
        Schema::dropIfExists('internos');
    }
}
