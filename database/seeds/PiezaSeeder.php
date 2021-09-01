<?php

use App\Campania;
use App\Interno;
use App\Pieza;
use Illuminate\Database\Seeder;

class PiezaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $p = new Pieza();
        // $p->campania()->associate(Campania::findOrFail(1));
        // $p->interno()->associate(Interno::where('cuix', '=', 1)->first());
        // $p->nombre = 'Deuda Julio 2020';
        // $p->destinatario_cuix = 20001078543;
        // $p->destinatario_nombre = "Patricia Irene";
        // $p->destinatario_apellido = "Juan Guillermo";
        // $p->fecha_disponibilidad = date('Y-m-d H:i:s', strtotime('2020-07-01 00:00:00'));
        // $p->fecha_notificado = date('Y-m-d H:i:s', strtotime('2020-07-02 00:00:00'));
        // $p->notificado_de_oficio = true;
        // $p->carga_batch = true;
        // $p->save();

        // $p = new Pieza();
        // $p->campania()->associate(Campania::findOrFail(2));
        // $p->interno()->associate(Interno::where('cuix', '=', 1)->first());
        // $p->nombre = 'Deuda Agosto 2020';
        // $p->destinatario_cuix = 20001078543;
        // $p->destinatario_nombre = "Patricia Irene";
        // $p->destinatario_apellido = "Juan Guillermo";
        // $p->fecha_disponibilidad = date('Y-m-d H:i:s', strtotime('2020-08-01 00:00:00'));
        // $p->notificado_de_oficio = false;
        // $p->carga_batch = true;
        // $p->save();
        
        // $p = new Pieza();
        // $p->campania()->associate(Campania::findOrFail(3));
        // $p->interno()->associate(Interno::where('cuix', '=', 1)->first());
        // $p->nombre = 'Intimación Deuda Tish 2019';
        // $p->destinatario_cuix = 20001078543;
        // $p->destinatario_nombre = "Patricia Irene";
        // $p->destinatario_apellido = "Juan Guillermo";
        // $p->archivo = '20001078543_deuda_2019.pdf';
        // $p->fecha_disponibilidad = date('Y-m-d H:i:s', strtotime('2020-08-01 00:00:00'));
        // $p->notificado_de_oficio = false;
        // $p->carga_batch = true;
        // $p->save();
        
        // $p = new Pieza();
        // $p->campania()->associate(Campania::findOrFail(3));
        // $p->interno()->associate(Interno::where('cuix', '=', 1)->first());
        // $p->nombre = 'Intimación Deuda 2019';
        // $p->destinatario_cuix = 20001078543;
        // $p->destinatario_nombre = "Patricia Irene";
        // $p->destinatario_apellido = "Juan Guillermo";
        // $p->archivo = '20001078543_deuda_2019.pdf';
        // $p->usuario_notificado_cuix = 20001078543;
        // $p->fecha_disponibilidad = date('Y-m-d H:i:s', strtotime('2020-06-01 00:00:00'));
        // $p->fecha_notificado = date('Y-m-d H:i:s', strtotime('2020-06-02 00:00:00'));
        // $p->notificado_de_oficio = false;
        // $p->carga_batch = true;
        // $p->save();

        // $p = new Pieza();
        // $p->campania()->associate(Campania::findOrFail(2));
        // $p->interno()->associate(Interno::where('cuix', '=', 1)->first());
        // $p->nombre = 'Deuda Agosto 2020';
        // $p->destinatario_cuix = 20348134664;
        // $p->destinatario_nombre = "Christine Leslie";
        // $p->destinatario_apellido = "Ann";
        // $p->fecha_disponibilidad = date('Y-m-d H:i:s', strtotime('2020-08-01 00:00:00'));
        // $p->notificado_de_oficio = false;
        // $p->carga_batch = true;
        // $p->save();

        // $p = new Pieza();
        // $p->campania()->associate(Campania::findOrFail(4));
        // $p->interno()->associate(Interno::where('cuix', '=', 1)->first());
        // $p->nombre = 'Fin de Año 2019';
        // $p->destinatario_cuix = 20001078543;
        // $p->destinatario_nombre = "Patricia Irene";
        // $p->destinatario_apellido = "Juan Guillermo";
        // $p->fecha_disponibilidad = date('Y-m-d H:i:s', strtotime('2019-12-01 00:00:00'));
        // $p->fecha_notificado = date('Y-m-d H:i:s', strtotime('2019-12-02 00:00:00'));
        // $p->usuario_notificado_cuix = 20001078543;
        // $p->notificado_de_oficio = false;
        // $p->carga_batch = true;
        // $p->save();
        
        // $p = new Pieza();
        // $p->campania()->associate(Campania::findOrFail(3));
        // $p->interno()->associate(Interno::where('cuix', '=', 1)->first());
        // $p->nombre = 'Intimación Deuda 2019';
        // $p->destinatario_cuix = 20348134664;
        // $p->destinatario_nombre = "Christine Leslie";
        // $p->destinatario_apellido = "Ann";
        // $p->archivo = '20348134664_deuda_2019.pdf';
        // $p->usuario_notificado_cuix = 20001082524;
        // $p->fecha_disponibilidad = date('Y-m-d H:i:s', strtotime('2020-06-01 00:00:00'));
        // $p->fecha_notificado = date('Y-m-d H:i:s', strtotime('2020-06-02 00:00:00'));
        // $p->notificado_de_oficio = false;
        // $p->carga_batch = true;
        // $p->save();

        // $p = new Pieza();
        // $p->campania()->associate(Campania::findOrFail(4));
        // $p->interno()->associate(Interno::where('cuix', '=', 1)->first());
        // $p->nombre = 'Fin de Año 2019';
        // $p->destinatario_cuix = 20348134664;
        // $p->destinatario_nombre = "Christine Leslie";
        // $p->destinatario_apellido = "Ann";
        // $p->fecha_disponibilidad = date('Y-m-d H:i:s', strtotime('2019-12-01 00:00:00'));
        // $p->fecha_notificado = date('Y-m-d H:i:s', strtotime('2019-12-02 00:00:00'));
        // $p->usuario_notificado_cuix = 20348134664;
        // $p->notificado_de_oficio = false;
        // $p->carga_batch = true;
        // $p->save();

        // $p = new Pieza();
        // $p->campania()->associate(Campania::findOrFail(3));
        // $p->interno()->associate(Interno::where('cuix', '=', 1)->first());
        // $p->nombre = 'Intimación Deuda 2018';
        // $p->destinatario_cuix = 20001078543;
        // $p->destinatario_nombre = "Patricia Irene";
        // $p->destinatario_apellido = "Juan Guillermo";
        // $p->archivo = '20001078543_deuda_2018.pdf';
        // $p->usuario_notificado_cuix = 20001078543;
        // $p->fecha_disponibilidad = date('Y-m-d H:i:s', strtotime('2019-01-01 00:00:00'));
        // $p->fecha_notificado = date('Y-m-d H:i:s', strtotime('2020-01-02 00:00:00'));
        // $p->notificado_de_oficio = false;
        // $p->carga_batch = true;
        // $p->save();
    }
}
