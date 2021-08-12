<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiezaExcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieza_excels', function (Blueprint $table) {
            $table->id();
            $table->string('id_fila', 20)->nullable();
            $table->bigInteger('campania_id');
            $table->bigInteger('interno_id');    
            $table->string('nombre', 255)->nullable();
            $table->bigInteger('destinatario_cuix')->nullable();
            $table->string('destinatario_nombre', 30)->nullable();
            $table->string('destinatario_apellido', 30)->nullable();
            $table->string('archivo', 50)->nullable();
            $table->bigInteger('usuario_lector_cuix')->nullable();
            $table->bigInteger('usuario_notificado_cuix')->nullable();
            $table->dateTime('fecha_disponibilidad', 0)->nullable();
            $table->dateTime('fecha_leido', 0)->nullable();
            $table->dateTime('fecha_notificado', 0)->default('9999-01-01');
            $table->boolean('notificado_de_oficio')->nullable();
            $table->boolean('carga_batch');
            $table->string('errores', 255);

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
        Schema::dropIfExists('pieza_excels');
    }
}
