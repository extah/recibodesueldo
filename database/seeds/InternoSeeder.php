<?php

use App\Dependencia;
use App\Interno;
use App\LugarPago;
use App\Rol;
use App\User;
use Illuminate\Database\Seeder;

class InternoSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $r = Rol::where('nombre', '=', 'Nuevo')->first();

        $i = new Interno();
        $i->cuix = '1';
        $i->email = 'bash@bash.com';
        $i->nombre = 'Bash';
        $i->apellido = 'Bash';
        $i->rol()->associate($r);
        $i->lugarPago()->associate(LugarPago::findOrFail(1));
        $i->save();
        $i->dependencias()->attach(Dependencia::findOrFail(1)->id);
        
        $i = new Interno();
        $i->cuix = '20001078543';
        $i->email = 'empleado@berisso.gob.ar';
        $i->rol()->associate($r);
        $i->lugarPago()->associate(LugarPago::findOrFail(1));
        $i->save();
        $i->dependencias()->attach(Dependencia::findOrFail(1)->id);
    }
}
