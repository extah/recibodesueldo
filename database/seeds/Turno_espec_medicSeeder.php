<?php

use Illuminate\Database\Seeder;
use App\Especialidades;
use App\Medico;
use App\Turno_espec_medic;

class Turno_espec_medicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $p = new Turno_espec_medic();
        $especialidad = Especialidades::where('id', 1)->get()->first();
        $p->id_especialidades = $especialidad->id;
        $medico = Especialidades::where('id', 1)->get()->first();
        $p->id_medico = $medico->id;
        $p->dia_horario = 'Lunes 12 hs, miércoles 13 hs y jueves 10 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono  A";
        $p->consulta_particular = "$700";
        $p->otros = '';
        $p->save();

    }
}
