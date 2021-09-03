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
        $tupla = Especialidades::where('id', 11)->get()->first();
        echo $tupla->id;
        $p->id_especialidades = $tupla->id;
        $p->id_medico = 1;
        $p->dia_horario = 'Lunes 12 hs, miércoles 13 hs y jueves 10 hs';
        $p->pami = 'NO';
        $p->obra_social = "IOMA bono  A";
        $p->consulta_particular = "$700";
        $p->otros = '';
        $p->save();

    }
}
