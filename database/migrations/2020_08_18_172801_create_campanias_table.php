<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interno_id');
            $table->foreignId('tipo_pieza_id');
            $table->foreignId('dependencia_id');

            $table->string('nombre', 255);
            $table->boolean('es_generica');
            $table->string('archivo', 50)->nullable();
            $table->boolean('activa');
            $table->dateTime('fecha_vigencia_desde', 0);
            $table->dateTime('fecha_vigencia_hasta', 0);
            $table->boolean('requiere_notificacion');
            $table->boolean('acepta_descargo');
            $table->boolean('firma_digital');
            $table->boolean('mail_de_cortesia');

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
        Schema::dropIfExists('campanias');
    }
}
