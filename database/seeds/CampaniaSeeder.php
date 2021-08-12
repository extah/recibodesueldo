<?php

use App\Campania;
use App\Dependencia;
use App\Interno;
use App\TipoPieza;
use App\User;
use Illuminate\Database\Seeder;

class CampaniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = new Campania();
        $u = Interno::where('cuix', '=', 1)->first();
        $c->interno()->associate($u);
        $c->dependencia()->associate(Dependencia::findOrFail(1)->first());
        $c->tipoPieza()->associate(TipoPieza::where('tipo', '=', 'NOTIFICACION')->first());
        $c->nombre = "Notificacion Deudores TISH Julio 2020";
        $c->es_generica = true;
        $c->archivo = "deudores_julio_2020.pdf";
        $c->activa = true;
        // $c->fecha_vigencia_desde = now()->subDays(1);
        $c->fecha_vigencia_desde = date('Y-m-d H:i:s', strtotime('2020-12-01 00:00:00'));
        $c->fecha_vigencia_hasta = date('Y-m-d H:i:s', strtotime('2021-03-15 00:00:00'));
        $c->requiere_notificacion = true;
        $c->acepta_descargo = false;
        $c->firma_digital = false;
        $c->mail_de_cortesia = true;
        $c->save();

        $c = new Campania();
        $u = Interno::where('cuix', '=', 1)->first();
        $c->interno()->associate($u);
        $c->dependencia()->associate(Dependencia::findOrFail(1)->first());
        $c->tipoPieza()->associate(TipoPieza::where('tipo', '=', 'NOTIFICACION')->first());
        $c->nombre = "Notificación Deudores TISH Agosto 2020";
        $c->es_generica = true;
        $c->archivo = 'deudores_agosto_2020.pdf';
        $c->activa = true;
        $c->fecha_vigencia_desde = date('Y-m-d H:i:s', strtotime('2020-12-01 00:00:00'));
        $c->fecha_vigencia_hasta = date('Y-m-d H:i:s', strtotime('2021-03-15 00:00:00'));
        $c->requiere_notificacion = true;
        $c->acepta_descargo = false;
        $c->firma_digital = false;
        $c->mail_de_cortesia = true;
        $c->save();

        $c = new Campania();
        $u = Interno::where('cuix', '=', 1)->first();
        $c->interno()->associate($u);
        $c->dependencia()->associate(Dependencia::findOrFail(1)->first());
        $c->tipoPieza()->associate(TipoPieza::where('tipo', '=', 'INTIMACION')->first());
        $c->nombre = "Intimación Deuda TISH  2019";
        $c->es_generica = false;
        $c->activa = true;
        $c->fecha_vigencia_desde = date('Y-m-d H:i:s', strtotime('2020-12-01 00:00:00'));
        $c->fecha_vigencia_hasta = date('Y-m-d H:i:s', strtotime('2021-12-01 00:00:00'));
        $c->requiere_notificacion = true;
        $c->acepta_descargo = false;
        $c->firma_digital = false;
        $c->mail_de_cortesia = true;
        $c->save();

        $c = new Campania();
        $u = Interno::where('cuix', '=', 1)->first();
        $c->interno()->associate($u);
        $c->dependencia()->associate(Dependencia::findOrFail(1)->first());
        $c->tipoPieza()->associate(TipoPieza::where('tipo', '=', 'COMUNICACION')->first());
        $c->nombre = "Saludo Fin de Año 2019";
        $c->es_generica = true;
        $c->archivo = 'saludo_2019.pdf';
        $c->activa = true;
        $c->fecha_vigencia_desde = date('Y-m-d H:i:s', strtotime('2020-12-01 00:00:00'));
        $c->fecha_vigencia_hasta = date('Y-m-d H:i:s', strtotime('2021-03-01 00:00:00'));
        $c->requiere_notificacion = false;
        $c->acepta_descargo = false;
        $c->firma_digital = false;
        $c->mail_de_cortesia = false;
        $c->save();

        $c = new Campania();
        $u = Interno::where('cuix', '=', 1)->first();
        $c->interno()->associate($u);
        $c->dependencia()->associate(Dependencia::findOrFail(1)->first());
        $c->tipoPieza()->associate(TipoPieza::where('tipo', '=', 'INTIMACION')->first());
        $c->nombre = "Intimación Deuda TISH  2018";
        $c->es_generica = false;
        $c->activa = true;
        $c->fecha_vigencia_desde = date('Y-m-d H:i:s', strtotime('2019-01-01 00:00:00'));
        $c->fecha_vigencia_hasta = date('Y-m-d H:i:s', strtotime('2021-01-01 00:00:00'));
        $c->requiere_notificacion = true;
        $c->acepta_descargo = false;
        $c->firma_digital = false;
        $c->mail_de_cortesia = true;
        $c->save();
    }
}
