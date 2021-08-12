<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiezasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piezas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('campania_id');
            $table->foreignId('interno_id');
            
            $table->string('nombre', 255);
            $table->bigInteger('destinatario_cuix');
            $table->string('destinatario_nombre', 30);
            $table->string('destinatario_apellido', 30);
            $table->string('archivo', 50)->nullable();
            $table->bigInteger('usuario_lector_cuix')->nullable();
            $table->bigInteger('usuario_notificado_cuix')->nullable();
            $table->dateTime('fecha_disponibilidad', 0);
            $table->dateTime('fecha_leido', 0)->nullable();
            $table->dateTime('fecha_notificado', 0)->default('9999-01-01');
            $table->boolean('notificado_de_oficio');
            $table->boolean('carga_batch');
            $table->softDeletes('deleted_at', 0);

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
        Schema::dropIfExists('piezas');
        Schema::table('piezas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
