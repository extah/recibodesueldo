<?php

use App\TipoPieza;
use Illuminate\Database\Seeder;

class TipoPiezaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tp = new TipoPieza();
        $tp->tipo = 'COMUNICACION';
        $tp->tipo_corto = 'COM';
        $tp->save();
        $tp = new TipoPieza();
        $tp->tipo = 'NOTIFICACION';
        $tp->tipo_corto = 'NOT';
        $tp->save();
        $tp = new TipoPieza();
        $tp->tipo = 'INTIMACION';
        $tp->tipo_corto = 'INT';
        $tp->save();
    }
}
